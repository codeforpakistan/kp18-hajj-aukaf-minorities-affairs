<div class="form-group form-float">                             
    <div class="form-line">
        {!! Form::select('fund_category_id', $fundCategories, null, [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Fund Category',
            'data-msg-required' => 'The Fund Category Name field is required.',
            'id' => 'select_fund_category_id',
            'required',
        ]) !!}
    </div>
</div>
<div class="form-group form-float">                             
    <div class="form-line">
        {!! Form::select('sub_category_id', $subCategories, null, [
            'class' => 'form-control show-tick',
            'label' => false,
            'placeholder' => 'Select Fund Sub Category',
            'data-msg-required' => 'The Fund Category Name field is required.',
            'id' => 'select_sub_category_id',
            'required',
        ]) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('fund_name', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Fund Name field is required.',
            'required',
        ]) !!}
        @error('fund_name')
            {!! Form::label('fund_name', $message, ['class' => 'error', 'id' => 'fund_name-error']) !!}
        @enderror
        {!! Form::label('fund_name', 'Fund Name', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('total_amount', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Total Amount field is required.',
            'required',
        ]) !!}
        @error('total_amount')
            {!! Form::label('total_amount', $message, ['class' => 'error', 'id' => 'total_amount-error']) !!}
        @enderror
        {!! Form::label('total_amount', 'Total Amount', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('fund_for_year', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Fund for Year field is required.',
            'required',
        ]) !!}
        @error('fund_for_year')
            {!! Form::label('fund_for_year', $message, ['class' => 'error', 'id' => 'fund_for_year-error']) !!}
        @enderror
        {!! Form::label('fund_for_year', 'Fund for Year', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::text('institute_students', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Percent of students per institute field is required.',
            'required',
        ]) !!}
        @error('institute_students')
            {!! Form::label('institute_students', $message, ['class' => 'error', 'id' => 'institute_students-error']) !!}
        @enderror
        {!! Form::label('institute_students', 'Percent of students per institute', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::date('last_date', null, [
            'class' => 'form-control',
            'data-msg-required' => 'The Last Date field is required.',
            'required',
        ]) !!}
        @error('last_date')
            {!! Form::label('last_date', $message, ['class' => 'error', 'id' => 'last_date-error']) !!}
        @enderror
        {!! Form::label('last_date', 'Last Date', ['class' => 'form-label']) !!}
    </div>
</div>
<div class="form-group form-float">
    <div class="form-line">
        {!! Form::hidden('active', '0') !!}
        {!! Form::checkbox('active', '1', isset($subCategory) ? null : true , [
            'class' => 'filled-in',
            'id' => 'active',
        ]) !!}
        {!! Form::label('active', 'Status') !!}
    </div>
</div>
@push('scripts')
    <script>
        $(document).ready(function() {
            $('#select_fund_category_id').change(function() {
                var value = $(this).val();
                if (value != "") {
                    $.ajax({
                        type: 'GET',
                        url: '{{ route("admin.api.ajax.sub-categories") }}',
                        data: 'fund_category_id='+value,
                        contentType: 'json',
                        success: function(data) {
                            var options = "<option>Select Fund Sub Category</option>";
                            if ( ! $.isEmptyObject(data) ) {
                                $.each(data,function(key,value){
                                    options += "<option value='" + key + "'>" + value + "</option>";
                                });
                            }
                            $('#select_sub_category_id').html(options);
                        }, error: function(error) {
                            // alert(JSON.stringify(error));
                        }
                    });
                } else {
                    $('#select_sub_category_id').empty();
                    $('#select_sub_category_id').append("<option>Select Fund Sub Category</option>");
                }
            });
        });     
    </script>
@endpush