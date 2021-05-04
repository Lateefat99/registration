<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Class') }}
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
            <div class="shadow overflow-hidden sm:rounded-md">
                <div class="px-3 py-3 bg-white sm:p-3">
                    <form action="{{route('studentByProgram')}}" method="GET">
                        @csrf
                        <div class="grid grid-cols-6 gap-3">
                            <div class="col-span-6 sm:col-span-1">
                                <label for="program_id" class="block text-sm font-medium text-gray-700">Student Type</label>
                                <select id="program_id" name="program_id" autocomplete="program_id"
                                        class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md
                                        shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500
                                        sm:text-sm">
                                    <option value=""></option>
                                    @foreach($programs as $program)
                                        <option value="{{$program->id}}">{{$program->name}}</option>
                                    @endforeach
                                </select>
                                <span style="color: red"> @error('program_id'){{$message}}@enderror</span>
                            </div>

                            <div class="px-4 py-3 text-left sm:px-3">
                                <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>

                    {{--<div class="grid grid-cols-6 gap-3">
                        <div class="px-3 py-3 text-left sm:px-3">
                            <a href="{{route('exportException', ['startDate' => $startDate, 'endDate' => $endDate, 'exception' => $exception])}}">

                                <button class="inline-flex justify-center py-2 px-4 border border-transparent
                                   shadow-sm text-sm font-medium rounded-md text-white bg-red-700 hover:bg-indigo-700
                                   focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Export</button>
                            </a>
                        </div>
                    </div>--}}

                    {{--<a href="{{ route('exportExcel', 'xls') }}"><button class="btn btn-success">Download Excel xls</button></a>
    <a href="{{ route('exportExcel', 'xlsx') }}"><button class="btn btn-success">Download Excel xlsx</button></a>
    <a href="{{ route('exportExcel', 'csv') }}"><button class="btn btn-success">Download CSV</button></a>--}}


                </div>

            </div>
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

                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                S/N
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Student Name
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Registration Number
                            </th>

                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Program Name
                            </th>


                            {{--<th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>--}}
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($test as $list)
                            @foreach($list->programs as $index => $register)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
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
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$list->name}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$list->reg_number}}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        {{$register->name}}
                                    </td>


                                </tr>
                            @endforeach
                        @endforeach


                        <!-- More items... -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
