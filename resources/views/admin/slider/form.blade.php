<div class="form-group">


    <button class="btn btn-success btn-lg btn-block" id="browseImgBtn">انتخاب تصویر</button>

        <div class="image-editor">
            <input type="file" id="selectFileInput" class="cropit-image-input hidden">
            <div class="cropit-preview" style="margin: 35px auto;"></div>
            <label>زوم تصویر</label>
            <input type="range" class="cropit-image-zoom-input">
            <button type="submit" class="btn btn-info btn-lg btn-block">برش</button>
        </div>

</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'ذخیره', ['class' => 'btn btn-primary']) !!}
    </div>
</div>
