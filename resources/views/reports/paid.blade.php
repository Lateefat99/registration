<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Payments') }}
        </h2>
    </x-slot>




    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <a href="../dashboard"> << Back </a>

    <div class="mt-10 sm:mt-0">

        <div class="mt-5 md:mt-0 md:col-span-2">
            <form action="{{route('report.paid')}}" method="GET">

                @csrf

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="startDate" class="block text-sm font-medium text-gray-700">Start Date</label>
                                <input type="date" name="startDate" id="startDate" value="{{ old('startDate') }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                <span style="color: red"> @error('startDate'){{$message}}@enderror</span>
                            </div>

                            <div class="col-span-6 sm:col-span-1">
                                <label for="endDate" class="block text-sm font-medium text-gray-700">End Date</label>
                                <input type="date" name="endDate" id="endDate" autocomplete="endDate" value="{{ old('endDate') }}"
                                       class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                            </div>

                            <div class="px-4 py-3 text-left sm:px-6">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            {{--<div class="grid grid-cols-6 gap-3">
                <div class="px-3 py-3 text-left sm:px-3">
                    <a href="{{route('exportPaid', ['startDate' => $startDate, 'endDate' => $endDate])}}">

                        <button class="inline-flex justify-center py-2 px-4 border border-transparent
                                   shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Export</button>
                    </a>
                </div>
            </div>--}}
        </div>
    </div>

    {{--<div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>--}}

    @if(\Illuminate\Support\Facades\Session::get('status'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{\Illuminate\Support\Facades\Session::get('status')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="flex flex-col">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">

                    <div style="display: none">
                        {{ $total = 0 }}
                        {{$bal = 0}}
                    </div>

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S/N
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Patient Name
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Amount Paid
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Balance
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Date
                            </th>


                            {{--<th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>--}}
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lists as $index => $list)
                            <tr>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="flex items-center">
                                        {{--<div class="flex-shrink-0 h-10 w-10">
                                            <img class="h-10 w-10 rounded-full" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt="">
                                        </div>--}}
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{++ $index}}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-3 whitespace-nowrap">
                                    <div class="bg-gray-400 max-w-xl mx-auto border border-gray-200" x-data="{selected:null}">
                                        <ul class="shadow-box">

                                            <li class="relative border-b border-gray-200">

                                                <button type="button" class="w-full px-8 py-6 text-left" @click="selected !== 1 ? selected = 1 : selected = null">
                                                    <div class="flex items-center justify-between">
                                                        <span>{{$list->register->name}}</span><span class="ico-plus"></span>
                                                    </div>
                                                </button>

                                                <div class="relative overflow-hidden transition-all max-h-0 duration-700" style="" x-ref="container1" x-bind:style="selected == 1 ? 'max-height: ' + $refs.container1.scrollHeight + 'px' : ''">
                                                    <div class="p-6">
                                                        <ol class="list-disc">
                                                            @foreach($list->creditDetails as $detail)
                                                                <li>{{$detail->amountPaid}} was paid on the {{$detail->created_at}} collected by {{$detail->collectedBy}}</li>
                                                            @endforeach
                                                        </ol>
                                                    </div>
                                                </div>

                                            </li>
                                        </ul>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-500">
                                                <span>&#8358;</span>{{number_format($list->amountPaid)}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="ml-4">
                                            <div class="text-sm text-gray-500">
                                                <span>&#8358;</span>{{number_format($list->balance)}}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{$list->created_at}}
                                </td>

                            </tr>

                            <div style="display: none">{{$total += $list->amountPaid}}</div>
                            <div style="display: none">{{$bal += $list->balance}}</div>

                            {{--<tr>
                                <td></td>
                                <td></td>
                                <td>asdf</td>
                                <td></td>
                                <td></td>
                            </tr>--}}
                        @endforeach

                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">Total:</td>
                            <td class="px-6 py-4 whitespace-nowrap"></td>
                            <td class="px-6 py-4 whitespace-nowrap"><span>&#8358;</span>{{number_format($total)}}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span>&#8358;</span>{{number_format($bal)}}</td>
                            <td class="px-6 py-4 whitespace-nowrap"><span>&#8358;</span>{{number_format($total + $bal)}}</td>
                        </tr>

                        <!-- More items... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>

