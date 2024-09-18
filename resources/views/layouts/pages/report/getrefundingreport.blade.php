<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="advanced"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="sales"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="refunding"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="refundingpaid"></h6>
    </td>
</tr>


<script>
    // Retrieve values passed from the backend
    var advance = "{{ $formattedAmountDue }}";
    var totalPurchase = "{{ number_format($totalPurchaseAmount, 2, '.', ',') }}";
    var refunding = "{{ number_format($totalRefundAmount, 2, '.', ',') }}";
    var refundPaid = "{{ $refundPaid }}";

    // Parse values for calculations
    var advanceAmount = parseFloat(advance.replace(/,/g, '').replace('(ADV)', '').trim());
    var totalPurchaseAmount = parseFloat(totalPurchase.replace(/,/g, ''));
    var refundingAmount = parseFloat(refunding.replace(/,/g, ''));
    var refundPaidAmount = parseFloat(refundPaid.replace(/,/g, ''));

    // Format amounts for display
    var formattedAdvance = advanceAmount < 0 ? Math.abs(advanceAmount).toFixed(2) + " (ADV)" : advanceAmount.toFixed(2);
    var formattedSales = totalPurchaseAmount.toFixed(2);
    var formattedRefunding = refundingAmount.toFixed(2);
    var formattedRefundPaid = refundPaidAmount.toFixed(2);

    // Update HTML content with formatted values
   

    if(advance == 0.00)
    {
        document.getElementById('sales').innerHTML = '';
        document.getElementById('refunding').innerHTML = '';
        document.getElementById('refundingpaid').innerHTML = '';

    }else{
        document.getElementById('advanced').innerHTML = formattedAdvance;
    document.getElementById('sales').innerHTML = formattedSales;
    document.getElementById('refunding').innerHTML = formattedRefunding;
    document.getElementById('refundingpaid').innerHTML = formattedRefundPaid;
    }
</script>





























