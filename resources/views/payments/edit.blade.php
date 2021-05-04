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
                                <h3 class="text-lg font-medium leading-6 text-gray-900"><strong><u>Balance: Update Student Payment here</u></strong></h3>
                                <table>
                                    <tr>
                                        <th>Student Name:</th>
                                        <td>{{$debtor->register->name}}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Billed:</th>
                                        <td>{{$debtor->amountBilled}}</td>
                                    </tr>
                                    <tr>
                                        <th>Amount Paid:</th>
                                        <td>{{$debtor->amountPaid}}</td>
                                    </tr>
                                    <tr>
                                        <th>Balance:</th>
                                        <td>{{$debtor->balance}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <form action="{{route('studentPayment.update', $debtor->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="shadow sm:rounded-md sm:overflow-hidden">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        <div class="grid grid-cols-3 gap-6">
                                            <div class="col-span-3 sm:col-span-2">
                                                <label for="balance" class="block text-sm font-medium text-gray-700">
                                                    Amount
                                                </label>
                                                <div class="mt-1 flex rounded-md shadow-sm">
                                                    <input type="text" name="balance" id="balance" autofocus class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Balance">
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
