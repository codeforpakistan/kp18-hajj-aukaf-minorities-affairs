<ul class="nav nav-pills nav-justified steps">
    <li>
        <a  style="" href="#tab2" data-toggle="tab" class="step">
            <span class="number">1</span>
            <span class="desc"><i class="icon-ok"></i> General Info</span>
        </a>
    </li>
    <li>
        <a  style="" href="#tab3" data-toggle="tab" class="step active">
            <span class="number">2</span>
            <span class="desc"><i class="icon-ok"></i> Contact Details</span>
        </a>
    </li>
    @if ($selectedFund->sub_category_id == 3)
        <li>
            <a  style="" href="#tab5" data-toggle="tab" class="step">
                <span class="number" id="q_num">3</span>
                <span class="desc"><i class="icon-ok"></i>Qualification details</span>
            </a>
        </li>
    @endif
    <li id="confirmation">
        <a style="" href="#tab4" data-toggle="tab" class="step">
            <span class="number" id="c_num" >
                {{ $selectedFund->sub_category_id == 3 ? '4' : '3' }}
            </span>
            <span class="desc"><i class="icon-ok"></i> Confirmation</span>
        </a>
    </li>
</ul>