<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="images/favicon.png" rel="icon" />
    <title>
        {{ $invoice->company->name }} | Invoice
    </title>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900'
        type='text/css'>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        .invoice-container {
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <!-- Container -->
    <div class="invoice-container container">
        <header>
            <div class="row align-items-center gy-3">
                <div class="col-sm-12 text-sm-start text-center">
                    <img id="logo" src="{{ $invoice->company->logo_url }}" title="{{ $invoice->company->name }}" alt="{{ $invoice->company->name }}" style="height: 100px" />
                </div>
            </div>
            <hr>
        </header>

        <main>
            <div class="row">
                <div class="col-7">
                    <form action="{{ route('process.payment') }}" method="POSt" id="processPayment">
                        <h3 class="mb-4 text-center">
                            <strong>Payment Details (
                                {{ $formatter->formatCurrency($invoice->total, $invoice->customer->currency->code) }}
                                )</strong>
                            {{-- invoice Id --}}

                        </h3>

                        @csrf
                        <input type="hidden" name="invoice" value="{{ $invoice->uuid }}" />

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="cc-name">Name on card</label>
                                <input type="text" class="form-control" name="card_name" id="cc-name" required>
                                <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                            </div>
                            <div class="col-md-6 col-12 mb-3">
                                <label for="cc-number">Credit card number</label>
                                <input type="text" class="form-control" name="card_number" id="cc-number" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="cc-expiration">Expiration(MM/YY)</label>
                                <input type="text" class="form-control" name="card_expiry" id="cc-expiration"
                                    required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <label for="cc-expiration">CVV(3 digits)</label>
                                <input type="text" class="form-control" name="card_cvv" id="cc-cvv" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                            </div>
                        </div>
                       

                        {{-- credit card banner --}}
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <img src="{{ asset('assets/images/cards-logos.png') }}" alt="Credit Card Logos" style="height: 40px" />
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <button type="submit" class="btn btn-primary w-100" id="contact-form-logo-btn-2">
                                Pay Now
                            </button>
                        </div>
                        <input type="hidden" name="source" value="{{ url()->full() }}" />
                    </form>
					<footer class="mt-4 text-center">
						<p class="text-1"><strong>NOTE :</strong>
							{{ $invoice->company->name }} is a registered company in {{ $invoice->company->address->country->name ?? '' }}.
						</p>
						<div class="btn-group btn-group-sm d-print-none"> 
							<a href="{{ $invoice->invoice_link }}" download class="btn btn-primary"><i class="fa fa-print"></i>
								Download Invoice</a> </div>
					</footer>
                </div>

                <div class="col-md-5 col-lg-4 order-md-last">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="">
                            Invoice #
                            {{ $invoice->invoice_id }}
                        </span>
                        <span class="badge bg-primary rounded-pill">
							{{ count($invoice->items) }}
						</span>
                    </h4>
                    <ul class="list-group mb-3">
                        @foreach ($invoice->items as $item)
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div>
                                    <h6 class="my-0">
                                        {{ $item['description'] }}
                                    </h6>
                                </div>
                                <span class="text-muted">
                                    {{ $formatter->formatCurrency($item['cost'], $invoice->customer->currency->code) }}
                                </span>
                            </li>
                        @endforeach

                        <li class="list-group-item d-flex justify-content-between">
                            <span>Total </span>
                            <strong>
                                {{ $formatter->formatCurrency($invoice->total, $invoice->customer->currency->code) }}
                            </strong>
                        </li>
                    </ul>
                </div>
            </div>

        </main>
        <!-- Footer -->
       
    </div>
</body>

</html>
