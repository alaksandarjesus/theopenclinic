<script type="text/html" id="consultation-summary-prescription-table">
<div class="overflow-auto">
    <table class="table-auto w-full">
        <thead>
        <tr>
    <th rowspan="2" class="p-2 border border-gray-200" style="width:60px"></th>
    <th rowspan="2" class="p-2 border border-gray-200">Drug</th>
    <th rowspan="2" class="p-2 border border-gray-200" style="width:50px">Days</th>
    <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Breakfast</th>
    <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Lunch</th>
    <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Evening</th>
    <th colspan="2" class="p-2 border border-gray-200" style="width:100px">Dinner</th>
</tr>
<tr>
    <th class="p-2 border border-gray-200" style="width:50px">B</th>
    <th class="p-2 border border-gray-200" style="width:50px">A</th>
    <th class="p-2 border border-gray-200" style="width:50px">B</th>
    <th class="p-2 border border-gray-200" style="width:50px">A</th>
    <th class="p-2 border border-gray-200" style="width:50px">B</th>
    <th class="p-2 border border-gray-200" style="width:50px">A</th>
    <th class="p-2 border border-gray-200" style="width:50px">B</th>
    <th class="p-2 border border-gray-200" style="width:50px">A</th>
</tr>
        </thead>
        <tbody>
            <% _.forEach(prescription.drugs, function(drug, index){ %> 
                <tr>
                    <td class="p-2 border border-gray-200 text-center"><%- (index + 1) %></td>
                    <td class="p-2 border border-gray-200"><%- drug.drugName %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.days %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.bb %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.ab %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.bl %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.al %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.be %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.ae %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.bd %></td>
                    <td class="p-2 border border-gray-200 text-center"><%- drug.ad %></td>
                </tr>
            <% }) %>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="11" class="p-2 border border-gray-200 text-left"><%- prescription.comments %></td>
            </tr>
        </tfoot>
    </table>
            </div>
</script>