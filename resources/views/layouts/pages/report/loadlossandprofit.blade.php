



@foreach($getlossandprofit as $transection)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $transection->VDate }}</td>
    <td>{{ $transection->UpdateBy }}</td>
    <td>{{ $transection->Description }}</td>
    <td>{{ $transection->Debit }}</td>
    <td>{{ $transection->Credit }}</td>
    <!-- Add other necessary columns here -->
</tr>
@endforeach


<t-footer style="display: none">
    <tr class="addr" >

        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>

        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>

        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px">Total</h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold; padding:0px; margin:0px" id="debitSumDisplay"></h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold; padding:0px; margin:0px" id="creditSumDisplay"></h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold; padding:0px; margin:0px" id="totalBalance"></h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">

        </td>
    </tr>
</t-footer>


<script>
    var debitsum = "{{ $formattedTotalDebit }}";
    var creditsum = "{{ $formattedTotalCredit }}";

    var debitAmount = parseFloat(debitsum.replace(/,/g, ''));
    var creditAmount = parseFloat(creditsum.replace(/,/g, ''));

    // Calculate the net amount
    var amount = debitAmount - creditAmount;

    // Round the amount based on the decimal part
    var totalDecimal = amount.toFixed(2).split('.')[1];
    if (parseInt(totalDecimal) >= 50) {
        amount = Math.ceil(amount);
    } else {
        amount = Math.floor(amount);
    }

    // Format the amount with commas
    var formattedAmount = amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    var resultText = amount >= 0 ? "Profit" : "Loss";
    var formattedResult = amount >= 0 ? formattedAmount : `(${formattedAmount})`;

    // Display the values in the respective elements
    document.getElementById('debitSumDisplay').innerHTML = debitsum;
    document.getElementById('creditSumDisplay').innerHTML = creditsum;
    document.getElementById('totalBalance').innerHTML = formattedResult + " (" + resultText + ")";
</script>









