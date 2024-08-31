

@foreach ($getcusReport as $item)
<tr>
    <td scope="col">{{ $loop->iteration }}</td>
    <td scope="col">{{ $item->grade->name }}</td>
    <td scope="col">{{ $item->black_stone}}</td>
    <td scope="col">{{ $item->mixed_builder}}</td>
    <td scope="col">{{ $item->dubai}}</td>
    <td scope="col">{{ $item->mm10}}</td>
    <td scope="col">{{ $item->pcc_cement}}</td>
    <td scope="col">{{ $item->opc_cement}}</td>
    <td scope="col">{{ $item->beg_cement}}</td>
    <td scope="col">{{ $item->sand}}</td>
    <td scope="col">{{ $item->admixer}}</td>
    <td scope="col">{{ $item->bricks}}</td>
</tr>
@endforeach


{{-- <t-footer style="display: none">
<tr class="addr" >
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid">

    </td>

    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">

    </td>
    <td style="border-top:1px solid; border-right:0px solid; border-bottom:1px solid;padding-top:6px;padding-bottom:6px">
        <h6 style="font-weight: bold;padding:0px;margin:0px;text-align:center;">Total Amount : </h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="" >
        </h6>
    </td>
    <td style="border-top:1px solid; border-left:0px solid; border-bottom:1px solid">
        <h6 style="font-weight: bold;padding:0px;margin:0px" id="debitSumDisplay" >
        </h6>
    </td>


</tr>
</t-footer> --}}
