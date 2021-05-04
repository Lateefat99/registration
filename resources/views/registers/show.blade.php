<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Information') }}
        </h2>
    </x-slot>

    <div>

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="mt-5 md:mt-0 md:col-span-2">

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
                                <div>
                                    <img class="h-50 w-50 rounded-full" src="{{'/studentsPictures' . $student->filename}}">
                                </div>
                                <table class="border-separate border border-green-800 ...">
                                    @if(isset($student))
                                        <tr>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <th class="border border-green-600 ...">Name:</th>
                                            <td class="border border-green-600 ...">{{strtoupper($student->name)}}</td>
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
                                            <th>Phone Number:</th>
                                            <td>{{strtoupper($student->phone)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Date of Birth:</th>
                                            <td>{{strtoupper($student->d_o_b)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Address:</th>
                                            <td>{{strtoupper($student->address)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Gender:</th>
                                            <td>{{strtoupper($student->gender)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Nationality:</th>
                                            <td>{{strtoupper($student->nationality)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Email:</th>
                                            <td>{{$student->email}}</td>
                                        </tr>

                                        <tr>
                                            <th>State of Origin:</th>
                                            <td>{{strtoupper($student->state_of_origin)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Class:</th>
                                            <td>{{strtoupper($student->health_status)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Blood Group:</th>
                                            <td>{{strtoupper($student->blood_group)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Guardian Name:</th>
                                            <td>{{strtoupper($student->guardian_name)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Guardian Phone:</th>
                                            <td>{{strtoupper($student->guardian_phone)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Genotype:</th>
                                            <td>{{strtoupper($student->genotype)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Allergy:</th>
                                            <td>{{strtoupper($student->allergy)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Card Number:</th>
                                            <td>{{strtoupper($student->card_number)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Registration Number:</th>
                                            <td>{{strtoupper($student->reg_number)}}</td>
                                        </tr>

                                        <tr>
                                            <th>Registration Date:</th>
                                            <td>{{strtoupper($student->reg_date)}}</td>
                                        </tr>

                                    @endif
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>

    </div>
</x-app-layout>
