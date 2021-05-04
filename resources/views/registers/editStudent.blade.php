<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Student Class') }}
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
                                    Search student with E-card or Registration number
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
                                <h3 class="text-lg font-medium leading-6 text-gray-900"><strong><u>Student Information:</u></strong></h3>
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Id
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Student Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Student Program
                                            </th>
                                            {{--<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Class
                                            </th>--}}
                                        </tr>
                                    </thead>
                                    @if(isset($student))
                                        @foreach($student->programs as $program)
                                        <tr>
                                            <td><img class="h-10 w-10 rounded-full" src="{{'/studentsPictures' . $student->filename}}"></td>

                                            <td>{{$student->name}}</td>

                                            <td><a href="{{route('editPro', $student->id)}}">{{$program->name}}</a> </td>

                                            {{--@foreach($student->programs as $program)
                                                <td>{{$program->pivot->student_class}}</td>
                                            @endforeach--}}
                                        </tr>

                                        @endforeach
                                    @endif
                                </table>
                            </div>
                        </div>
                        <div class="mt-5 md:mt-0 md:col-span-2">
                            @if(isset($findProgram))
                            <form action="{{route('updateProgram', $findProgram->id)}}" method="POST">
                                @csrf
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white sm:p-6">
                                        <div class="grid grid-cols-6 gap-6">
                                            <div class="col-span-6 sm:col-span-2">
                                                <label for="program" class="block text-sm font-medium text-gray-700">Program Type</label>
                                                <select id="program_id" name="program_id" autocomplete="program_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">

                                                        <option value="{{$findProgram->name}}">{{$findProgram->name}}</option>
                                                    @foreach($programs as $type)
                                                        <option value="{{$type->id}}">{{$type->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-span-6 sm:col-span-2">
                                                <label for="studentClass" class="block text-sm font-medium text-gray-700">Class</label>
                                                <select id="studentClass" name="studentClass" autocomplete="studentClass" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                    <option></option>
                                                    @foreach($studentClasses as $plan)
                                                        <option value="{{$plan->name}}">{{$plan->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            @if(isset($student))
                                                <input type="hidden" name="reg_id" value="{{$student->id}}">
                                            @endif

                                        </div>
                                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Add to Program
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
