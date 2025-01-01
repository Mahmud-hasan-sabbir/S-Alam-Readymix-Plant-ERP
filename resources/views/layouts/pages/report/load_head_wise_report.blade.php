




@foreach ($getexpense as $item )
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->VDate }}</td>
    <td scope="col">{{ $item->Vtype}}</td>
    <td scope="col">{{ $item->Description}}</td>
    <td scope="col">{{ $item->Credit}}</td>

</tr>
@endforeach


<t-footer style="display: none">
    <tr class="addr" >
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

        </td>

        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

        </td>
        <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
            <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;margin-left:175px">Total</h6>
        </td>
        <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
            <h6 style="font-weight: bold;padding:0px;margin:0px" id="debitSumDisplay" >
            </h6>
        </td>


    </tr>
</t-footer>


<script>
    var creditsum = {{ $totalCredit }};
    document.getElementById('debitSumDisplay').innerHTML = creditsum.toFixed(2);

</script>









