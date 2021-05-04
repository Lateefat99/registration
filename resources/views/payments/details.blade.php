<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment Update') }}
        </h2>
    </x-slot>

    <div>


        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div>
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900"><strong><u>Exception: Correct Student Payment here</u></strong></h3>
                                @if(isset($payment))
                                <table>
                                    <tr>
                                        <th>Student Name:</th>
                                        <td>{{$payment->register->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Billed:</th>
                                        <td>{{$payment->amountBilled}}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Paid:</th>
                                        <td>{{$payment->amountPaid}}</td>
                                    </tr>
                                    <tr>
                                        <th>Balance:</th>
                                        <td>{{$payment->balance}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <h3 class="text-lg font-medium leading-6 text-gray-900"><strong><u>Payment Details</u></strong></h3>
                            <table>
                                <tr>
                                    <th>Amount Paid</th>
                                    <th>Collected By</th>
                                    <th>Edit</th>
                                </tr>
                                @foreach($payment->creditDetails as $details)
                                <tr>
                                        <td>{{$details->amountPaid}}</td>
                                        <td>{{$details->collectedBy}}</td>
                                        <td>
                                            <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                                <a href="{{route('detail.edit', $details->id)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                </tr>
                                @endforeach

                            </table>
                            @endif
                            @if(isset($detail))
                            <form action="{{route('detail.update', $detail->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        <div class="grid grid-cols-3 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <label for="amount" class="block text-sm font-medium text-gray-700">
                                                    Amount
                                                </label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                        <input type="text" name="amount" id="amount" value="{{$detail->amountPaid}}" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Balance">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                    <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Update Payment
                                    </button>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="hidden sm:block" aria-hidden="true">
                    <div class="py-5">
                        <div class="border-t border-gray-200"></div>
                    </div>
                </div>

            </div>
        </div>

    </div>

</x-app-layout>
