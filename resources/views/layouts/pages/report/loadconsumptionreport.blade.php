
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>Customer Name</th>
        <th>Grade</th>
        <th>Qty</th>
        <th>Admixer</th>
        <th>10MM</th>
        <th>Mexed Builder</th>
        <th>Balack Stone</th>
        <th>Dubai</th>
        <th>Sand</th>
        <th>pcc_cement</th>
        <th>opc_cement</th>
        <th>beg_cement</th>
        <th>Bricks</th>
    </tr>


@foreach ($consumptions as $item)
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->date }}</td>
    <td scope="col">{{ $item->customer->company_name}}</td>
    <td scope="col">{{ $item->grade->name}}</td>
    <td scope="col">{{ $item->quantity}}</td>
    <td scope="col">{{ $item->admixer}}</td>
    <td scope="col">{{ $item->mm10}}</td>
    <td scope="col">{{ $item->mixed_builder}}</td>
    <td scope="col">{{ $item->black_stone}}</td>
    <td scope="col">{{ $item->dubai}}</td>
    <td scope="col">{{ $item->sand}}</td>
    <td scope="col">{{ $item->pcc_cement}}</td>
    <td scope="col">{{ $item->opc_cement}}</td>
    <td scope="col">{{ $item->beg_cement}}</td>
    <td scope="col">{{ $item->bricks}}</td>
</tr>
@endforeach


<tr class="addr" >
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid"></td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid"></td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid"></td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;width:50px">Total : </h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="toqty"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="toadmix"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="tomm10"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="tomixedbuilder"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="toblackstor"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="todubai"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="tosand"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="topcccement"></h6>
    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="toopccement"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="tobegcement"></h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;" id="tobricks"></h6>
    </td>
</tr>



<script>
    var totalqty = {{ $totalqty }};
    var totalblackstone = {{ $totalblackstone }};
    var mixed_builder = {{ $mixed_builder }};
    var dubai = {{ $dubai }};
    var mm10 = {{ $mm10 }};
    var pcc_cement = {{ $pcc_cement }};
    var opc_cement = {{ $opc_cement }};
    var beg_cement = {{ $beg_cement }};
    var sand = {{ $sand }};
    var admixer = {{ $admixer }};
    var bricks = {{ $bricks }};

    // Set value only if it's not null, undefined, or 0, otherwise show an empty string
    document.getElementById('toqty').innerHTML = totalqty ? totalqty : '';
    document.getElementById('toadmix').innerHTML = admixer ? admixer : '';
    document.getElementById('tomm10').innerHTML = mm10 ? mm10 : '';
    document.getElementById('tomixedbuilder').innerHTML = mixed_builder ? mixed_builder : '';
    document.getElementById('toblackstor').innerHTML = totalblackstone ? totalblackstone : '';
    document.getElementById('todubai').innerHTML = dubai ? dubai : '';
    document.getElementById('tosand').innerHTML = sand ? sand : '';
    document.getElementById('topcccement').innerHTML = pcc_cement ? pcc_cement : '';
    document.getElementById('toopccement').innerHTML = opc_cement ? opc_cement : '';
    document.getElementById('tobegcement').innerHTML = beg_cement ? beg_cement : '';
    document.getElementById('tobricks').innerHTML = bricks ? bricks : '';
</script>


