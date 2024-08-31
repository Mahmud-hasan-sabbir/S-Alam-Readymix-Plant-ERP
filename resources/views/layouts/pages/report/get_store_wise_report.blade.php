
<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id="">SL</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Material Name:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Purchase Quantity:</h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Sale Quantity:</h6>
    </td>



</tr>
@foreach ($getStoreReport as $item)
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $item->material->name }}</td>
    <td>{{ $item->pur_qty }}</td>
    <td>{{ $item->sale_qty }}</td>
</tr>
@endforeach

<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Total:</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="totalpur"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="totalsale" ></h6>
    </td>



</tr>
<tr class="addr" id="landPurchaseTr">
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted" class="text-muted" id=""></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted">Available Material :</h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" id="curmaterial"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-muted;" class="text-muted" ></h6>
    </td>



</tr>



<script>
    var pursu  = {{ $pursum }};
    var salesu = {{ $salesum }};
    var curmat = pursu - salesu;
    document.getElementById('totalpur').innerHTML = pursu;
    document.getElementById('totalsale').innerHTML = salesu;
    document.getElementById('curmaterial').innerHTML = curmat;

</script>
























