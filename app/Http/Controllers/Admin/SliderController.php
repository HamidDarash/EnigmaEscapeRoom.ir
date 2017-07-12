<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Slider;
use Illuminate\Http\Request;
use Mockery\Exception;
use Session;
use File;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        session(['current_menu_select' => 'slider']);
        $slider = Slider::all();
        return view('admin.slider.index', compact('slider'));
    }

//    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\View\View
//     */
//    public function create()
//    {
//        return view('admin.slider.create');
//    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $requestData = $request->all();
        try {
            $slider = Slider::create($requestData);
        } catch (Exception $exception) {
            $return_message = [
                'message' => 'در هنگام درج اسلایدر ' . $exception . 'رخ داد',
                'mode' => 0,
                'filename' => ''
            ];
            return $return_message;

        }
        if ($requestData['image-data']) {
            try {
                $data = $requestData['image-data'];
                $pos = strpos($data, ';');
                $type = explode(':', substr($data, 0, $pos))[1];
                list($type, $data) = explode(';', $data);
                list(, $data) = explode(',', $data);
                $decoded = base64_decode($data);

                $lowerCase = strtolower($type);
                $extension = 'unknown';
                if (strpos($lowerCase, "png") !== false) {
                    $extension = "png";
                } else if (strpos($lowerCase, "jpg") !== false || strpos($lowerCase, "jpeg") !== false) {
                    $extension = "jpg";
                } else if (strpos($lowerCase, "bmp") !== false) {
                    $extension = "bmp";
                } else if (strpos($lowerCase, "tiff") !== false) {
                    $extension = "tiff";
                } else if (strpos($lowerCase, "gif") !== false) {
                    $extension = "gif";
                }
                $filename = 'slider_' . $slider->id . '.' . $extension;
                file_put_contents(public_path() . '/img/slider/' . $filename, $decoded);
                $slider->sliderpicture = $filename;
                $slider->alt = 'slider_' . $slider->id;
                $slider->save();

            } catch (Exception $exception) {

                $return_message = [
                    'message' => 'در هنگام درج تصویر برای اسلایدر ' . $exception . 'رخ داد',
                    'mode' => 0,
                    'filename' => ''
                ];
                return $return_message;
            }
        }
        $return_message = [
            'message' => 'عکس بدرستی درج گردید',
            'mode' => 1,
            'filename' => $filename
        ];
        return $return_message;
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return \Illuminate\View\View
//     */
//    public function show($id)
//    {
//        $slider = Slider::findOrFail($id);
//
//        return view('admin.slider.show', compact('slider'));
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int $id
//     *
//     * @return \Illuminate\View\View
//     */
//    public function edit($id)
//    {
//        $slider = Slider::findOrFail($id);
//
//        return view('admin.slider.edit', compact('slider'));
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  int $id
//     * @param \Illuminate\Http\Request $request
//     *
//     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
//     */
//    public function update($id, Request $request)
//    {
//
//        $requestData = $request->all();
//
//        $slider = Slider::findOrFail($id);
//        $slider->update($requestData);
//
//        Session::flash('flash_message', 'Slider updated!');
//
//        return redirect('admin/slider');
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            if ($slider->sliderpicture) {
                $deletePath = base_path() . '/public/img/slider/' . $slider->sliderpicture;
                if (File::exists($deletePath)) {
                    File::delete($deletePath);
                }
            }
            $slider = Slider::destroy($id);
        } catch (Exception $ex) {
            Session::flash('flash_message', $ex->getMessage());
        }

        Session::flash('flash_message', 'اسلاید مورد نظر بدرسی حذف گردید');
        return redirect('/admin/slider');
    }
}
