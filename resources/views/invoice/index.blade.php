@extends('layouts.app')

@section('content')
	<div class="container mx-auto">
		<style>
		  body {background:gray !important;}
		</style>

		<div class="heading text-center font-bold text-2xl m-5 text-gray-100">
			Invoice Manager
		</div>

		<div class="bg-white p-8 rounded-md w-full">
			@include('partials.messages')
			<div class=" flex items-center justify-between pb-6">
				<div>
					<h2 class="text-gray-600 font-semibold">Invoices</h2>
					<span class="text-xs">All invoice item</span>
				</div>

				<div class="flex items-center justify-between">
						@if(Route::has('import_csv_custom'))
							<form action="{{ route('import_csv_custom') }}" method="POST" enctype="multipart/form-data" class="lg:ml-40 ml-10 space-x-8">
							@csrf
							<div class="flex items-center justify-center bg-red-100">
						      <div class="bg-white rounded-xl border p-3 max-w-lg">
						        <div class="flex flex-col items-center space-y-2">
						          <h1 class="font-bold text-xl text-gray-700 w-4/6 text-center">
						            Upload with Custom Code
						          </h1>
						          <input
						            type="file"
						            class="border-2 rounded-lg w-full h-12 px-4"
						            name="invoiceDoc"
						            value=""
						            required
						          />
						          <button type="submit" 
						            class="bg-blue-400 text-white rounded-md hover:bg-green-500 font-semibold px-4 py-3 w-full"
						          >
						            Upload
						          </button>
						        </div>
						      </div>
						    </div>
							</form>
						@endif

						@if(Route::has('import_csv_maatwebsite'))
							<form action="{{ route('import_csv_maatwebsite') }}" method="POST" enctype="multipart/form-data" class="lg:ml-40 ml-10 space-x-8">
							@csrf
							<div class="flex items-center justify-center bg-red-100">
						      <div class="bg-white rounded-xl border p-3 max-w-lg">
						        <div class="flex flex-col items-center space-y-2">
						          <h1 class="font-bold text-xl text-gray-700 w-4/6 text-center">
						            Upload with Maatwebsite Excel
						          </h1>
						          <input
						            type="file"
						            class="border-2 rounded-lg w-full h-12 px-4"
						            name="invoiceDoc"
						            value=""
						            required
						          />
						          <button type="submit" 
						            class="bg-blue-400 text-white rounded-md hover:bg-green-500 font-semibold px-4 py-3 w-full"
						          >
						            Upload
						          </button>
						        </div>
						      </div>
						    </div>
							</form>
						@endif
					</div>
				</div>
				<div>
					<div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
						<div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
							<table class="min-w-full leading-normal">
								<thead>
									<tr>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											InvoiceNo
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											StockCode
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											Description
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											Quantity
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											InvoiceDate
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											UnitPrice
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											CustomerID
										</th>
										<th
											class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
											Country
										</th>
									</tr>
								</thead>
								<tbody>
									@foreach($invoices as $key => $invoice)
										<tr>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<div class="flex items-center">
													<div class="flex-shrink-0 w-10 h-10">
		                                        	</div>
													<div class="ml-3">
														<p class="text-gray-900 whitespace-no-wrap">
															{{$invoice->InvoiceNo}}
														</p>
													</div>
												</div>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">{{$invoice->StockCode}}</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{$invoice->Description}}
												</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{$invoice->Quantity}}
												</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{Carbon\Carbon::parse($invoice->InvoiceDate)->format('d M Y H:i')}}
												</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{$invoice->UnitPrice}}
												</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{$invoice->CustomerID}}
												</p>
											</td>
											<td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
												<p class="text-gray-900 whitespace-no-wrap">
												{{$invoice->Country}}
												</p>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
				{{$invoices->links('pagination::tailwind')}}
			</div>
	</div>

@endsection