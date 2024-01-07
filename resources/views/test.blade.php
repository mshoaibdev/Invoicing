
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Email Template</title>
    <style>
    * {
      margin: 0px;
      padding: 0px;
      box-sizing: border-box;
    }
    </style>
  </head>
  <body style="margin: 0px; background: #f4f4f4">
    <div
      style="
        padding: 20px;
        margin: auto;
        background-image: url('https://res.cloudinary.com/dxsqw4dbf/image/upload/v1704477555/2_qqyzic.png'),
          url('https://res.cloudinary.com/dxsqw4dbf/image/upload/v1704477555/1_ezkhhy.png');
        background-repeat: no-repeat, no-repeat;
        background-position: top left, bottom right;
        background-size: 40%, 40%;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS',
          sans-serif;
      "
    >

    @php
    $formatter = new NumberFormatter($invoice->customer->currency->code,  NumberFormatter::CURRENCY);
  @endphp
      <table style="width: 100%;">
        <thead>
          <tr>
            <td>
              <table style="width: 100%; margin-bottom: 20px">
                <tr>
                  <td>
                    <h1
                      style="
                        font-family: Georgia, 'Times New Roman', Times, serif;
                        font-size: 46px;
                        font-weight: 400;
                      "
                    >
                      INVOICE
                    </h1>
                  </td>
                  <td style="text-align: right">
                    @if ($invoice->company->logo_url)
                        <img  src="{{ asset($invoice->company->logo_url) }}" alt="Company Logo" width="200"> 
                    @else
                        @if ($invoice->company)
                            <h2 > {{ $invoice->company->name }}</h2>
                        @endif
                    @endif
                  </td>
                </tr>
              </table>
            </td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <table style="width: 100%">
                <tr>
                  <td style="vertical-align: bottom">
                    <div
                      style="
                        border: 2px dotted #333;
                        border-radius: 15px;
                        padding: 20px;
                      "
                    >
                      <p style="margin: 0px">Invoice To:</p>
                      <h2 style="margin: 10px 0">{{ $invoice->customer->billing->name }}</h2>
                      <p style="margin: 0px; padding: 0px">
                        Company name: {{ $invoice->customer->company_name  ?? ''}}<br />
                        Phone: {{ $invoice->customer->billing->phone ?? '' }}<br />
                        Email: {{ $invoice->customer->email ?? '' }}<br />
                        Address: {{ $invoice->customer->billing->city ?? '' }}
                        {{ $invoice->customer->billing->state  ?? ''}} 
                        {{ $invoice->customer->billing->zip ?? '' }}, 
                        {{ $invoice->customer->billing->country->name ?? ''}}
                      </p>
                    </div>
                  </td>
                  <td style="width: 15%"></td>
                  <td style="vertical-align: bottom; width: 32.5%">
                    <div
                      style="
                        border: 2px dotted #333;
                        border-radius: 15px;
                        padding: 20px;
                      "
                    >
                      <p style="margin: 0px; padding: 0px">
                        Date : {{ $invoice->created_at_formatted }}
                      </p>
                      <p style="margin: 0px; padding: 0px">Invoice {{ $invoice->invoice_id }}</p>
                      <p style="margin: 0px; padding: 0px">PO #</p>
                    </div>
                  </td>
                </tr>
              </table>
              <table
                style="
                  width: 100%;
                  border-collapse: collapse;
                  margin: 10px 0 20px;
                "
              >
                <thead>
                  <tr>
                    <th
                      style="
                        text-align: left;
                        background: #000;
                        padding: 10px;
                        color: #fff;
                      "
                    >
                      SL.
                    </th>
                    <th
                      style="
                        text-align: left;
                        background: #000;
                        padding: 10px;
                        color: #fff;
                      "
                    >
                      Item Description
                    </th>
                    <th
                      style="
                        text-align: left;
                        background: #000;
                        padding: 10px;
                        color: #fff;
                      "
                    >
                      Price
                    </th>
                    <th
                      style="
                        text-align: left;
                        background: #000;
                        padding: 10px;
                        color: #fff;
                      "
                    >
                      Qty.
                    </th>
                    <th
                      style="
                        text-align: left;
                        background: #000;
                        padding: 10px;
                        color: #fff;
                      "
                    >
                      Total
                    </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($invoice->items as $item)
                  <tr>
                    <td style="font-weight: 600; padding: 10px">{{ $loop->iteration }}</td>
                    <td style="font-weight: 600; padding: 10px">
                      {{ $item['title'] }}
                    </td>
                    <td style="font-weight: 600; padding: 10px"> {{ $formatter->formatCurrency($item['cost'], $invoice->customer->currency->code) }}</td>
                    <td style="font-weight: 600; padding: 10px">{{$item['quantity']}}</td>
                    <td style="font-weight: 600; padding: 10px"> {{ $formatter->formatCurrency($item['total'], $invoice->customer->currency->code) }}</td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <table
                style="
                  margin: 40px 0 20px;
                  width: 100%;
                  font-family: 'Trebuchet MS', 'Lucida Sans Unicode',
                    'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
                "
              >
                <tr>
                  <td style="vertical-align: top">
                    <strong style="font-weight: 700; font-size: 18px"
                      >Thank you for your bussiness</strong
                    >
                  </td>
                  <td style="vertical-align: top; width: 30%">
                    <table style="width: 100%; margin-left: auto">
                      <tr>
                        <td>
                          <strong style="font-weight: 700">Sub total</strong>
                        </td>
                        <td>
                          <strong style="font-weight: 700">: {{ $formatter->formatCurrency($invoice->subtotal, $invoice->customer->currency->code) }}</strong>
                        </td>
                      </tr>
                      {{-- <tr>
                        <td>
                          <strong style="font-weight: 700">Discount</strong>
                        </td>
                        <td>
                          <strong style="font-weight: 700">: 0.00%</strong>
                        </td>
                      </tr> --}}
                      <tr>
                        <td>
                          <strong style="font-weight: 700">Tax ({{ $invoice->tax_percentage }}%)</strong>
                        </td>
                        <td>
                          <strong style="font-weight: 700">: {{ $formatter->formatCurrency($invoice->tax_amount, $invoice->customer->currency->code) }}</strong>
                        </td>
                      </tr>

                      <tr>
                        <td>
                          <strong style="font-weight: 700">Vat ({{ $invoice->vat_percentage }}%)</strong>
                        </td>
                        <td>
                          <strong style="font-weight: 700">: {{ $formatter->formatCurrency($invoice->vat_amount, $invoice->customer->currency->code) }}</strong>
                        </td>
                      </tr>

                    </table>
                  </td>
                </tr>
              </table>

              <table style="width: 100%">
                <thead>
                  <tr>
                    <th>
                      <div
                        style="
                          padding: 8px 30px;
                          box-sizing: border-box;
                          text-align: left;
                          background: #000;
                          color: #fff;
                          font-size: 20px;
                          font-weight: 700;
                          border-radius: 35px;
                        "
                      >
                        Notes
                      </div>
                    </th>
                    <th style="width: 10%"></th>
                    <th>
                      <div
                        style="
                          margin-left: auto;
                          padding: 8px 30px;
                          box-sizing: border-box;
                          text-align: center;
                          background: #000;
                          color: #fff;
                          font-size: 20px;
                          font-weight: 700;
                          border-radius: 35px;
                        "
                      >
                        <table style="width: 100%">
                          <td
                            style="
                              padding: 0px;
                              line-height: 1.2;
                              text-align: left;
                            "
                          >
                            Total
                          </td>
                          <td
                            style="
                              padding: 0px;
                              line-height: 1.2;
                              text-align: right;
                            "
                          >
                          {{ $formatter->formatCurrency($invoice->total, $invoice->customer->currency->code) }}
                          </td>
                        </table>
                      </div>
                    </th>
                  </tr>
                </thead>
              </table>

              <table style="width: 100%; margin-bottom: 20px">
                <tbody>
                  <td
                    style="vertical-align: top; padding: 20px 5px; width: 50%"
                  >
                    <div
                      style="
                        border: 2px dotted #333;
                        border-radius: 15px;
                        padding: 15px 20px;
                        font-size: 14px;
                      "
                    >
                    {!! $invoice->note !!}
                    </div>
                  </td>
                  <td
                    style="
                      vertical-align: top;
                      padding: 20px 5px;
                      width: 50%;
                      text-align: right;
                    "
                  >
                    @if($invoice->payment_link !== '')
                    <a href="{{ $invoice->payment_link }}">
                      <img
                        src="https://res.cloudinary.com/dxsqw4dbf/image/upload/v1704556360/Group_2_e5j6ic.png"
                        width="150"
                      />
                    </a>
                    @endif
                    <br />
                    @if($invoice->paymentMethod->name == "Authorized.net")
                    <img
                      src="https://res.cloudinary.com/dxsqw4dbf/image/upload/v1704476400/ghaatsjj5jxxbmjwutj6.png"
                      alt="Authorize.net"
                      width="100"
                    />
                    @elseif($invoice->paymentMethod->name == "PayPal")
                    <img
                      src="https://www.paypalobjects.com/webstatic/mktg/logo/pp_cc_mark_111x69.jpg" alt="Paypal" width="100" />
                      @endif
                  </td>
                </tbody>
              </table>
            </td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td
              style="
                text-align: center;
                border-top: 1px solid #d9d9d9;
                padding: 20px 0 0;
              "
            >
              <p style="font-size: 14px; margin: 0 0 5px">
                <strong>{{ $invoice->company->name }}</strong>  {{ $invoice->company->address->address_street_1 ?? '' }}
                {{ $invoice->company->address->city ?? '' }} 
                {{ $invoice->company->address->state ?? '' }} 
                {{ $invoice->company->address->zip ?? '' }} 
                {{ $invoice->company->address->country->name ?? '' }}
              </p>
              <p style="font-size: 14px; margin: 0 0 5px">
                <a
                  href="tel:2812153298"
                  style="color: #000; text-decoration: none"
                  ><strong>{{ $invoice->company->address->phone ?? '' }}</strong></a
                >
              </p>
              @if($invoice->company->website)
              <p style="font-size: 14px; margin: 0 0 5px">
                <a
                  href="{{ $invoice->company->website ?? '' }}"
                  style="color: #000; text-decoration: none"
                >
                  <strong>{{ $invoice->company->website ?? '' }}</strong>
                </a>
              </p>
              @endif
            </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </body>
</html>
