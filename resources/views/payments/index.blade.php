<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment List/') }} <a href="{{route('studentPayment.create')}}" class="bg-black hover:bg-gray-800 rounded-full text-white bg-cover">Make Payment</a>
        </h2>
    </x-slot>

    @if(\Illuminate\Support\Facades\Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{\Illuminate\Support\Facades\Session::get('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
@endif
    <!-- component -->
    <div style="display: none">
        {{ $total = 0 }}
        {{$bal = 0}}
    </div>

    <div class="container">


        <table class="text-left w-full">
            <thead class="bg-black flex text-white w-full">
            <tr class="flex w-full mb-4">
                <th class="p-4 w-1/4">S/N</th>
                <th class="p-4 w-1/4">Student Name</th>
                <th class="p-4 w-1/4">Plan Type</th>
                <th class="p-4 w-1/4">Amount Paid</th>
                <th class="p-4 w-1/4">Balance</th>
                <th class="p-4 w-1/4">Expiry Date</th>
                <th class="p-4 w-1/4">Status</th>
                <th class="p-4 w-1/2">Payment Details</th>
                <th class="p-4 w-1/4">Action</th>
            </tr>
            </thead>
            <!-- Remove the nasty inline CSS fixed height on production and replace it with a CSS class — this is just for demonstration purposes! -->
            <tbody class="bg-grey-light flex flex-col items-center justify-between overflow-y-scroll w-full" style="height: 50vh;">
            @foreach($payments as $index => $payment)
            <tr class="flex w-full mb-4">
                <td class="p-4 w-1/4">{{++ $index}}</td>
                <td class="p-4 w-1/4">
                @if ($payment->balance == 0)
                    {{$payment->register->name}}
                @else
                    <a href="{{route('studentPayment.edit', $payment->id)}}" class="hover:bg-white bg-cover">
                        {{$payment->register->name}}
                    </a>
                @endif
                </td>
                <td class="p-4 w-1/4">{{$payment->planType}}</td>
                <td class="p-4 w-1/4"><span>&#8358;</span>{{$payment->amountPaid}}</td>
                <td class="p-4 w-1/4"><span>&#8358;</span>{{$payment->balance}}</td>
                <td class="p-4 w-1/4">{{$payment->expiryDate}}</td>
                <td class="p-4 w-1/4">
                    {{$validity = checkValidity($payment->expiryDate)}}
                    @if ($validity == 'Valid')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-300 text-green-800">
                                                                {{$validity}}
                                                            </span>
                    @elseif ($validity == 'Expired')
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-400 text-red-800">
                                                                {{$validity}}
                                                            </span>
                    @endif
                </td>
                <td class="px-4 py-3">
{{--                    {{$detail->collectedBy}}--}}

                    <div class="bg-gray-400 max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">
                        <ul class="shadow-box">

                            <li class="relative border-b border-gray-200">

                                <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                    <div class="flex items-center justify-between">
					                    <span>Payment Details</span><span class="ico-plus"></span>
                                    </div>
                                </button>

                                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                    <div class="p-6">
                                        <ol class="list-disc">
                                            @foreach($payment->creditDetails as $detail)
                                                <li>{{$detail->amountPaid}} was paid on the {{$detail->created_at}} collected by {{$detail->collectedBy}}</li>
                                            @endforeach
                                        </ol>
                                    </div>
                                </div>

                            </li>
                        </ul>
                    </div>

                </td>

                <td class="p-4 w-1/4">
                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                        @if(\Illuminate\Support\Facades\Auth::user()->role == 'admin')
                        <a href="{{route('studentPayment.show', $payment->id)}}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                            </svg>
                        </a>
                        @endif
                    </div>
                </td>
            </tr>
            <div style="display: none">{{$total += $payment->amountPaid}}</div>
            <div style="display: none">{{$bal += $payment->balance}}</div>
            @endforeach

            <tr class="flex w-full mb-4">
                <td class="p-4 w-1/4">Total:</td>
                <td class="p-4 w-1/4"></td>
{{--                <td class="p-4 w-1/4"></td>--}}
                <td class="p-4 w-1/4"><span>&#8358;</span>{{number_format($total)}}</td>
                <td class="p-4 w-1/4"><span>&#8358;</span>{{number_format($bal)}}</td>
                <td class="p-4 w-1/4"></td>
                <td class="p-4 w-1/4"><span>&#8358;</span>{{number_format($total + $bal)}}</td>
                <td class="p-4 w-1/4"></td>
            </tr>

            {{$payments->links()}}
            </tbody>
        </table>
    </div>
</x-app-layout>
