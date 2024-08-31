
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<style type="text/css"> * {margin:0; padding:0; text-indent:0; }
    h1 { color: black; font-style: normal; font-weight: bold; text-decoration: none; font-size: 18pt; }
    p { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 11pt; margin:0pt; }
    .s1 { color: #7D7D7D; font-family:Arial, sans-serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 10.5pt; }
    .s2 { color: #7D7D7D; font-family:Arial, sans-serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 10.5pt; }
    .s3 { color: #485056; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 10.5pt; }
    h2 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: bold; text-decoration: none; font-size: 12pt; }
    .s4 { color: black; font-family:"Times New Roman", serif; font-style: normal; font-weight: normal; text-decoration: none; font-size: 1pt; }
    table, tbody {vertical-align: top; overflow: visible; }
</style>

</head>

<body>
    <br>
    <br>
        <div style="margin: auto">
            <h1 style="padding-top: 3pt;text-indent: 0pt;text-align: center;">Rajshahi Officers Housing Scheme </h1>
        </br>
            <p style="text-indent: 0pt;text-align: center;">Project of Savar-based Rajshahi Multipurpose Cooperative Society Ltd.</p>
            <p style="padding-bottom: 2pt;text-indent: 0pt;line-height: 153%;text-align: center;">North Jamshing, Savar Municipality, Post: P.I.T.C., Savar, Dhaka-1343</p>
            <p style="padding-bottom: 2pt;text-indent: 0pt;line-height: 153%;text-align: center;">Website: www.rohs-bd.org
            </p>
            <br>
            <div style="border:1px solid;border-radius: 25px;width:25%;margin:auto">
                <h2 style="padding: 3pt;text-indent: 0pt;text-align: center;">{{ $firstRecord->Vtype }} Voucher</h2>
            </div>
        </div>
<table style="border-collapse:collapse;margin:auto;margin-top:25px">

    <tr style="height:16pt">
        <td style="width:109pt"><p class="s1" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;"></p></td>
        {{-- <td style="width:193pt"><p class="s2" style="padding-top: 1pt;padding-left: 25pt;text-indent: 0pt;text-align: left;margin-left:-100px">{{ $firstRecord->memberName->Saller_name }}</p></td> --}}
         <td style="width:193pt"><p class="s2" style="padding-top: 1pt;padding-left: 25pt;text-indent: 0pt;text-align: left;margin-left:-100px"></p></td>
         <td style="width:136pt">
            <p class="s1" style="padding-top: 1pt;padding-left: 35pt;text-indent: 0pt;text-align: left;">Head Name:</p>
        </td>
        <td style="margin-left:-20px"><p class="s2" style="margin-left:-20px">{{ $firstRecord->headName->HeadName }}</p></td>

    </tr>
    <br>
    <tr style="height:16pt">
        <td style="width:109pt"><p class="s1" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;">Name : </p></td>
        {{-- <td style="width:193pt"><p class="s2" style="padding-top: 1pt;padding-left: 25pt;text-indent: 0pt;text-align: left;margin-left:-100px">{{ $firstRecord->memberName->Saller_name }}</p></td> --}}
         <td style="width:193pt"><p class="s2" style="padding-top: 1pt;padding-left: 25pt;text-indent: 0pt;text-align: left;margin-left:-100px">{{ $name }}</p></td>
         <td style="width:136pt">
            <p class="s1" style="padding-top: 1pt;padding-left: 35pt;text-indent: 0pt;text-align: left;">Date:</p>
        </td>
        <td style=""><p class="s2" style="">{{ $firstRecord->VDate }}</p></td>
    </tr>
    <br>
    <tr style="height:17pt">
        <td colspan="2" style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: left;"><b>Particulars : </b>
            </p>
        </td>
        <td colspan="2" style="width:181pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;"><b>Amount </b>
            </p>
        </td>
    </tr>
    @foreach ($data as $item )
    <tr style="height:17pt">
        <td colspan="2" style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: left;">{{ $item->headName->HeadName}} ({{ $item->HeadCode }})
            </p>

        </td>
        @if ($item->Vtype === 'Debit')
        <td colspan="2" style="width:181pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;">{{ $item->Debit }}
            </p>
        </td>
        @elseif ($item->Vtype === 'Credit')
        <td colspan="2" style="width:181pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;">{{ $item->Credit }}
            </p>
        @endif
        {{-- <td colspan="2" style="width:181pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;">{{ $item->Debit }}
            </p>
        </td> --}}
    </tr>
    @endforeach
    <tr style="height:17pt">
        <td colspan="2" style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;">Total : </p>

        </td>

        <td colspan="2" style="width:181pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: right;margin-right:1pt">{{ $total }}.00
            </p>
        </td>
    </tr>
    <tr style="height:17pt">
        <td colspan="4" style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: left;">In Words : </p>

        </td>

    </tr>
    <tr style="height:17pt">
        <td  style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: left;">Description : </p>


        </td>
        <td colspan="3" style="width:148pt;border-top-style:solid;border-top-width:2pt;border-top-color:#EDEDED;border-left-style:solid;border-left-width:1pt;border-left-color:#EDEDED;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#EDEDED;border-right-style:solid;border-right-width:1pt;border-right-color:#EDEDED">
            <p class="s1" style="padding-top: 2pt;padding-left: 7pt;text-indent: 0pt;line-height: 12pt;text-align: left;"> {{ $remarks->Description }}</p>


        </td>

    </tr>


</table>

<br>
<table style="border-collapse:collapse;margin:auto;margin-top:25px">
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <tr style="height:16pt">
        <td style="width:109pt"><p class="s1" style="padding-top: 1pt;padding-left: 2pt;text-indent: 0pt;text-align: left;text-decoration: overline;">Received By</p></td>
        <td style="width:193pt"><p class="s1" style="padding-top: 1pt;padding-left: 100pt;text-indent: 0pt;text-align: left;text-decoration: overline;">Checked By</p></td>
        <td style="width:136pt">
            {{-- <p class="s1" style="padding-top: 1pt;padding-left: 35pt;text-indent: 0pt;text-align: left;">Department:</p> --}}
        </td>
        <td style="margin-left:-20px"><p class="s1" style="margin-left:-20px;text-decoration: overline;">Approved By</p></td>
        {{-- <td style="width:136pt">
            <p class="s1" style="padding-top: 1pt;padding-left: 35pt;text-indent: 0pt;text-align: left;">Department:</p>
        </td> --}}
    </tr>
    <br>

</table>
    </body>
</html>



