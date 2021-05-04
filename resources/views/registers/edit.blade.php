<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Update Student Record') }}
        </h2>
    </x-slot>

    <div class="hidden sm:block" aria-hidden="true">
        <div class="py-5">
            <div class="border-t border-gray-200"></div>
        </div>
    </div>

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Students Bio Data</h3>
                    <p class="mt-1 text-sm text-gray-600">
                        Use a permanent address where you can receive mail.
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <form action="{{route('student.update', $student->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                            <div class="grid grid-cols-6 gap-6">

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                                    <label class="inline-flex items-center mt-3">
                                        <input type="radio" name="title" class="form-radio h-5 w-5 text-gray-600" value="{{$student->title}}"><span class="ml-2 text-gray-700">Mr</span>
                                        <input type="radio" name="title" class="form-radio h-5 w-5 text-gray-600" value="{{$student->title}}"><span class="ml-2 text-gray-700">Mrs</span>
                                        <input type="radio" name="title" class="form-radio h-5 w-5 text-gray-600" value="{{$student->title}}"><span class="ml-2 text-gray-700">Miss</span>
                                    </label>
                                    <span style="color: red"> @error('title'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name(Surname First)</label>
                                    <input type="text" name="name" id="name" autocomplete="given-name" value="{{$student->name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('name'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                    <input type="text" name="phone" id="phone" autocomplete="phone" value="{{$student->phone}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('phone'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-4">
                                    <label for="email_address" class="block text-sm font-medium text-gray-700">Email address</label>
                                    <input type="text" name="email" id="email" autocomplete="email" value="{{$student->email}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('email'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-2">
                                    <label for="studentType" class="block text-sm font-medium text-gray-700">Student Type</label>
                                        @foreach($student->programs as $stud)
                                            @if(isset($stud))
                                                <input type="text" name="studentType" id="studentType"  autocomplete="studentType" value="{{$stud->name}}" readonly class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                            @endif
                                        @endforeach

                                    <span style="color: red"> @error('studentType'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Nationality</label>
                                    <input type="text" name="nationality" id="nationality" autocomplete="nationality" value="{{$student->nationality}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('nationality'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <label for="health_status" class="block text-sm font-medium text-gray-700">Health Status</label>
                                    <input type="text" name="health_status" id="health_status" autocomplete="health_status" value="{{$student->health_status}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('health_status'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6">
                                    <label for="address" class="block text-sm font-medium text-gray-700">Street address</label>
                                    <input type="text" name="address" id="address" autocomplete="street-address" value="{{$student->address}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('address'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="d_o_b" class="block text-sm font-medium text-gray-700">Date Of Birth</label>
                                    <input type="date" name="d_o_b" id="d_o_b" value="{{$student->d_o_b}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('d_o_b'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="state_of_origin" class="block text-sm font-medium text-gray-700">State Of Origin</label>
                                    <input type="text" name="state_of_origin" id="state_of_origin" value="{{$student->state_of_origin}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('state_of_origin'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="blood_group" class="block text-sm font-medium text-gray-700">Blood Group</label>
                                    <select id="blood_group" name="blood_group" autocomplete="blood_group"
                                            class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="{{$student->blood_group}}">{{$student->blood_group}}</option>
                                        <option value="o_pos">O Pos</option>
                                        <option value="o_neg">O Neg</option>
                                        <option value="a_pos">A Pos</option>
                                        <option value="a_neg">A Neg</option>
                                        <option value="b_pos">B Pos</option>
                                        <option value="b_neg">B Neg</option>
                                        <option value="ab_pos">AB Pos</option>
                                        <option value="ab_neg">AB Neg</option>
                                    </select>
                                    <span style="color: red"> @error('blood_group'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="genotype" class="block text-sm font-medium text-gray-700">Genotype</label>
                                    <input type="text" name="genotype" id="genotype" autocomplete="genotype" value="{{$student->genotype}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('genotype'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="nok" class="block text-sm font-medium text-gray-700">Next Of Kin</label>
                                    <input type="text" name="guardian_name" id="guardian_name" value="{{$student->guardian_name}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('guardian_name'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="guardian_phone" class="block text-sm font-medium text-gray-700">Next Of Kin Contact</label>
                                    <input type="text" name="guardian_phone" id="guardian_phone" value="{{$student->guardian_phone}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('guardian_phone'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
                                    <select id="gender" name="gender" autocomplete="gender"  class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                        <option value="{{$student->gender}}">{{$student->gender}}</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                    <span style="color: red"> @error('gender'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="allergy" class="block text-sm font-medium text-gray-700">Allergy(If Any)</label>
                                    <input type="text" name="allergy" id="allergy" value="{{$student->allergy}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('allergy'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-6 lg:col-span-2">
                                    <label for="reg_date" class="block text-sm font-medium text-gray-700">Registration Date</label>
                                    <input type="date" name="reg_date" id="reg_date" value="{{$student->reg_date}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('reg_date'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="reg_number" class="block text-sm font-medium text-gray-700">Registration Number</label>
                                    <input type="text" name="reg_number" id="reg_number" value="{{$student->reg_number}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('reg_number'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="class" class="block text-sm font-medium text-gray-700">Class</label>
                                        @foreach($student->programs as $stud)
                                            <input type="text" name="admitted_class" id="admitted_class" value="{{$stud->pivot->student_class}}" readonly class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        @endforeach
                                    <span style="color: red"> @error('admitted_class'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <label for="card_number" class="block text-sm font-medium text-gray-700">Card Number</label>
                                    <input type="text" name="card_number" id="card_number" value="{{$student->card_number}}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                    <span style="color: red"> @error('card_number'){{$message}}@enderror</span>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <div class="cell">
                                        <video id="player" autoplay></video>
                                    </div>
                                </div>
                                <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                                    <div class="cell">
                                        <canvas id="canvas" width="320px" height="240px"></canvas>
                                    </div>
                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-1">

                                </div>

                                <div class="col-span-6 sm:col-span-3 lg:col-span-1">
                                    <div>
                                        <button type="button" class="inline-flex justify-right py-2 px-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 " id="capture-btn">Capture</button>
                                    </div>
                                </div>

                                <input type="hidden" id="image_name" name="image_name" value="{{$student->filename}}">

                            </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Save
                            </button>
                        </div>
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



</x-app-layout>
@include('layouts.footer')

<style>
    #newImages {
        height: 300px;
        position: relative;
        width: 100%;
        text-align: center;
        margin-right: auto;
        margin-left: -150px;
    }
    img.masked {
        position: absolute;
        background-color: #fff;
        border: 1px solid #babbbd;
        padding: 10px;
        box-shadow: 1px 1px 1px #babbbd;
        margin: 10px auto 0;
    }
    #player {
        width: 320px;
        height: 240px;
        margin: 10px auto;
        border: 1px solid #babbbd;
    }
    canvas {
        width: 320px;
        height: 240px;
        margin: 10px auto;
        border: 1px solid #babbbd;
    }
    #capture-btn {
        width: 130px;
        margin: 0 auto;
    }
    #pick-image {
        display: none;
        text-align: center;
        padding-top: 30px;
    }
</style>

<script type="text/javascript" src="../../js/script.js"></script>
<script type="text/javascript" src="../../js/jquery-ui.min.js"></script>
<!-- <script type="text/javascript" src="../../js/webcam.min.js"></script> -->
