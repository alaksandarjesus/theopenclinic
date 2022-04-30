<h4 class="text-lg font-medium my-2">Prescription</h4>
<div class="overflow-auto">
<table class="table-auto w-full consultation-prescription"
    data-prescription-uuid="{{!empty($consultation->prescription)?$consultation->prescription->uuid:''}}">
    <thead>
        @include('consultation.form-elements.prescription-header')

    </thead>
    <tbody>
        @if(!empty($consultation->prescription))
        @include('consultation.form-elements.prescription-on-update')
        @endif
    </tbody>
    <tfoot>
        <tr>
            <td colspan="11" class="border border-gray-200 p-0">
                <textarea name="comments" class="comments w-full h-24"
                    placeholder="Comments">{{!empty($consultation->prescription)?$consultation->prescription->comments:''}}</textarea>
            </td>
        </tr>
    </tfoot>
</table>
</div>
@include('consultation.form-elements.prescription-row-template')