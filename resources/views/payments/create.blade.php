<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Payment') }}
        </h2>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">
                    <div>
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">Verification</h3>
                                    <p class="mt-1 text-sm text-gray-600">
                                        Verify student with E-card or Registration number
                                    </p>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="" method="GET">
                                    <div class="shadow sm:rounded-md sm:overflow-hidden">
                                        <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                            <div class="grid grid-cols-3 gap-6">
                                                 <div class="col-span-3 sm:col-span-2">
                                                    <label for="cardRegNo" class="block text-sm font-medium text-gray-700">
                                                        Card/Reg Number
                                                    </label>
                                                    <div class="mt-1 flex rounded-md shadow-sm">
                                                        <input type="text" name="cardRegNo" id="cardRegNo" autofocus class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-r-md sm:text-sm border-gray-300" placeholder="Place the E-Card or Input Registration Number">
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                            <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                    search
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

                    <div class="mt-10 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900"><strong><u>Student/Payment Information:</u></strong></h3>
                                    <table>
                                        @if(isset($student))
                                            <tr>
                                                <td><img class="h-50 w-50 rounded-full" src="{{'/studentsPictures' . $student->filename}}"></td>
                                            </tr>
                                            <tr>
                                                <th>Student Name:</th>
                                                <td>{{strtoupper($student->name)}}</td>
                                            </tr>

                                            <tr>
                                                <th>Gender:</th>
                                                <td>{{strtoupper($student->gender)}}</td>
                                            </tr>

                                            <tr>
                                                <th>Student Program(s):</th>
                                                @foreach($student->programs as $program)
                                                    <td>{{strtoupper($program->name)}}</td>
                                                @endforeach
                                            </tr>

                                            <tr>
                                                <th>Class:</th>
                                                <td>{{strtoupper($student->admitted_class)}}</td>
                                            </tr>

                                            <tr>
                                                <th>Payment Status:</th>
                                                    <td>
                                                        @if(count($student->valid($currentDate)) >= 1)
                                                            @foreach($student->valid($currentDate) as $payment)
                                                                    <span class="px-4 inline-flex text-xs leading-5 font-semibold rounded-b-none bg-green-300 text-green-800">
                                                                        {{checkValidity($payment->expiryDate)}}
                                                                    </span>
                                                                    {{__(' expires on')}} {{$payment->expiryDate}}
                                                            @endforeach
                                                        @elseif($student->invalid($currentDate))
                                                            <span class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-800 text-green-800">
                                                                {{checkValidity($student->invalid($currentDate)->expiryDate)}}
                                                            </span>
                                                            {{__(' expired on')}} {{$student->invalid($currentDate)->expiryDate}}
                                                        @else
                                                            <span class="px-4 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-800 text-white">
                                                                {{('No previous payment made')}}
                                                            </span>
                                                        @endif
                                                    </td>
                                            </tr>

                                            <tr>
                                            <tr>
                                                <th>Payment Balance:</th>
                                                @if(isset($payment))
                                                <td><span>&#8358;</span>{{$payment->balance}}</td>
                                                @endif
                                            </tr>

                                            </tr>

                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <form action="{{route('studentPayment.store')}}" method="POST">
                                    @csrf
                                    <div class="shadow overflow-hidden sm:rounded-md">
                                        <div class="px-4 py-5 bg-white sm:p-6">
                                            <div class="grid grid-cols-6 gap-6">
                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="program" class="block text-sm font-medium text-gray-700">Program Type</label>
                                                    <select id="program" name="program" autocomplete="program" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                        <option></option>
                                                        @foreach($programs as $type)
                                                            <option value="{{$type->name}}">{{$type->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="planType" class="block text-sm font-medium text-gray-700">Plan Type</label>
                                                    <select id="planType" name="planType" autocomplete="planType" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                        <option></option>
                                                        @foreach($plans as $plan)
                                                            <option value="{{$plan->name}}">{{$plan->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="amountPaid" class="block text-sm font-medium text-gray-700">Amount Paid</label>
                                                    <input type="text" name="amountPaid" id="amountPaid" autocomplete="amountPaid" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                <div class="col-span-6 sm:col-span-2">
                                                    <label for="startDate" class="block text-sm font-medium text-gray-700">Payment Reading Date</label>
                                                    <input type="date" name="startDate" id="startDate" autocomplete="startDate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                                </div>

                                                @if(isset($student))
                                                    <input type="hidden" name="reg_id" value="{{$student->id}}">
                                                @endif

                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Pay
                                            </button>
                                        </div>
                                    </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

            </div>
        </div>

    </div>
</x-app-layout>
