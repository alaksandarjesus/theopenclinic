<div class="tab-body">
    <div class="tab-profile tab-content ">
        @include('consultation.profile')
    </div>
    <div class="tab-user-custom-fields hidden  tab-content">
        @include('consultation.user-custom-fields')
    </div>
    <div class="tab-previous-consultation hidden  tab-content">
        @include('consultation.previous-consultations')
    </div>
    <div class="tab-pre-consultation hidden  tab-content">
        @include('consultation.pre-consultation')
    </div>
    <div class="tab-complaints hidden  tab-content">
        @include('consultation.form-elements.complaints')
    </div>
    <div class="tab-examination hidden  tab-content">
        @include('consultation.form-elements.examination')

    </div>
    <div class="tab-prescription hidden  tab-content">
        @include('consultation.form-elements.prescription')
    </div>
    <div class="tab-others hidden  tab-content">
        @include('consultation.form-elements.others')
    </div>
    <div class="tab-summary hidden  tab-content">
        @include('consultation.summary.summary')
    </div>
</div>

