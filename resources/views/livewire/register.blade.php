
<div class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
<div>
    <a href="/">
<svg class="w-16 h-16" viewbox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M11.395 44.428C4.557 40.198 0 32.632 0 24 0 10.745 10.745 0 24 0a23.891 23.891 0 0113.997 4.502c-.2 17.907-11.097 33.245-26.602 39.926z" fill="#6875F5"/>
    <path d="M14.134 45.885A23.914 23.914 0 0024 48c13.255 0 24-10.745 24-24 0-3.516-.756-6.856-2.115-9.866-4.659 15.143-16.608 27.092-31.75 31.751z" fill="#6875F5"/>
</svg>
</a>
</div>

<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">

      <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form name="frmRegistration" wire:submit.prevent="register" enctype="multipart/form-data">
            @csrf
          
            <div>

                @if(session()->has('message'))
        
                    
                <div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md" role="alert">
                    <div class="flex">
                      <div class="py-1"><svg class="fill-current h-6 w-6 text-teal-500 mr-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"/></svg></div>
                      <div>
                        <p class="font-bold"> {{ session('message') }}</p>
                        <!--<p class="text-sm"></p>-->
                      </div>
                    </div>
                  </div>
                       
        
                   
        
                @endif

             @if($error)
        
             <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Error: </strong>
                <span class="block sm:inline">{{ $error }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                  <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
              </div>
                    
    
              
    
            @endif

        
            </div>
            @if($form==1  || $form_all==1)
            <div>
                <x-jet-label for="salutation_id" value="{{ __('Salutation') }}" />
                <!--<x-jet-input id="salutation" class="block mt-1 w-full" type="text" name="salutation" :value="old('salutation')" required autofocus autocomplete="salutation" />-->
                 <div>
                    <select id="salutation_id" wire:model="salutation_id" name="salutation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option value=""  selected>--Select--</option>
                      @foreach ($master_salutation as $row)
                      <option value="{{$row->id}}">{{$row->value}}</option>
                      @endforeach
                    </select>
                  </div>

            </div>
                  
          
            <div>
                <x-jet-label for="firstname" value="{{ __('First Name') }}" />
                <x-jet-input id="firstname"  wire:model="firstname" value="test" class="block mt-1 w-full" type="text" name="firstname"  required autofocus autocomplete="firstname" />
            </div>

            <div>
                <x-jet-label for="lastname" value="{{ __('Lastname') }}" />
                <x-jet-input id="lastname" wire:model="lastname" value="t" class="block mt-1 w-full" type="text" name="lastname"  required autofocus autocomplete="name" />
            </div>

            
            
            <div class="mt-4">
                <x-jet-label for="gender_id" value="{{ __('Gender') }}" />
                      

              <select id="gender_id" wire:model="gender_id" name="gender_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value=""  selected>--Select--</option>
                @foreach ($master_gender as $row)
                <option value="{{$row->id}}">{{$row->value}}</option>
                @endforeach
              </select>

            </div>

            <div class="mt-4">
                <x-jet-label for="phone" value="{{ __('Phone') }}" />
                <x-jet-input id="phone" wire:model="phone" value="9898989" class="block mt-1 w-full" type="text" name="phone"  required autofocus autocomplete="phone" />
            </div>

            <div>
                <x-jet-label for="mobile" value="{{ __('Mobile') }}" />
                <x-jet-input id="mobile" wire:model="mobile" value="8989898" class="block mt-1 w-full" type="text" name="mobile" autofocus autocomplete="mobile" />
            </div>

            <div>
                <x-jet-label for="primary_address" value="{{ __('Primary Address') }}" />
                <textarea id="primary_address" wire:model="primary_address" class="block mt-1 w-full" type="text" name="primary_address" autofocus autocomplete="primary_address">#34,west</textarea>
            </div>
            
            <div>
                <x-jet-label for="secondary_address" value="{{ __('Secondary Address') }}" />
                <textarea id="secondary_address" wire:model="secondary_address" class="block mt-1 w-full" type="text" name="secondary_address" :value="old('secondary_address')"  autofocus autocomplete="secondary_address"></textarea>
            </div>
            
            <div>
                <x-jet-label for="dob" value="{{ __('Date of Birth') }}" />
                <x-jet-input id="dob"   wire:model="dob" class="block mt-1 w-full" type="text" name="dob" required  autocomplete="dob" />
            </div>
          

            <div>
                <x-jet-label for="assumed_date" value="{{ __('Assumed Date') }}" />
                <x-jet-input id="assumed_date" readonly  wire:model="assumed_date"  class="block mt-1 w-full" type="text" name="assumed_date"   autocomplete="assumed_date" />
            </div>

            <div class="flex md:justify-between justify-center items-center mt-10">
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                <p class="md:mx-2 text-sm font-light text-gray-400"> Company Details </p> 
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
            </div>
           <!-- <div>
                <div class="float-right -my-8">
                <x-jet-button type="button" wire:click="formShow(2)" class="ml-4">
                    {{ __('Continue') }}
                </x-jet-button>
                </div>
            </div>
        -->
            @endif

            @if($form==2  || $form_all==1)
            <div>
                <x-jet-label for="occupation_id" value="{{ __('occupation') }}" />
                 <div>
                    <select id="occupation_id" wire:model="occupation_id" name="occupation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option value="">--Select--</option>
                      @foreach ($master_occupation as $row)
                      <option value="{{$row->id}}">{{$row->value}}</option>
                      @endforeach
                    </select>
                  </div>

            </div>

            <div>
                <x-jet-label for="company_name" value="{{ __('Company Name') }}" />
                <x-jet-input id="company_name" wire:model="company_name" value="DIG" class="block mt-1 w-full" type="text" name="company_name"  autofocus autocomplete="company_name" />
            </div>

            <div>
                <x-jet-label for="company_address" value="{{ __('Company Address') }}" />
                <textarea id="company_address" wire:model="company_address" class="block mt-1 w-full" type="text" name="company_address" autocomplete="company_address"></textarea>
            </div>
            <div>
                <x-jet-label for="industry_id" value="{{ __('Industry') }}" />
                 <div>
                    <select id="industry_id" name="industry_id" wire:click="getSubIndustry()" wire:model="industry_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option value="">--Select--</option>
                      @foreach ($master_industry as $row)
                <option value="{{$row->id}}">{{$row->value}}</option>
                @endforeach
                    </select>
                  </div>

            </div>
            <div>
                <x-jet-label for="sub_industry_id" value="{{ __('Sub Industry') }}" />
                 <div>
                    <select id="sub_industry_id" name="sub_industry_id" wire:model="sub_industry_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      <option value="">--Select--</option>
                      @foreach ($master_sub_industry as $row)
                <option value="{{$row->id}}">{{$row->value}}</option>
                @endforeach
                    </select>
                  </div>

            </div>



            <div class="flex md:justify-between justify-center items-center mt-10">
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                <p class="md:mx-2 text-sm font-light text-gray-400"> Skills </p> 
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
            </div>


          
            <div>
                <x-jet-label for="skill" value="{{ __('Skill') }}" />
                <x-jet-input id="skill" value="Laravel" wire:model="skill" class="block mt-1 w-full" type="text" name="skill" required autofocus autocomplete="skill" />
            </div>
          
            <div>
                <x-jet-label for="rate" value="{{ __('Rate') }}" />
                 <div>
                    <select id="rate" name="rate" wire:model="rate" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      @for ($i=1;$i<=10;$i++) 
                      <option value="{{ $i }}">{{ $i }}</option>
                      @endfor
                    </select>
                  </div>

            </div>

           <!-- <div class="float-left">
                <x-jet-button type="button" wire:click="formShow(1)" class="ml-4">
                    {{ __('Back') }}
                </x-jet-button>
            </div>

            <div class="float-right">
                <x-jet-button type="button" wire:click="formShow(3)" class="ml-4">
                    {{ __('Continue') }}
                </x-jet-button>
            </div>
        -->

            @endif

            @if($form==3  || $form_all==1)
            <div class="flex md:justify-between justify-center items-center mt-10">
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                <p class="md:mx-2 text-sm font-light text-gray-400"> Family Details </p> 
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
            </div>

            <div>
                <x-jet-label for="family_firstname" value="{{ __('First Name') }}" />
                <x-jet-input id="family_firstname" wire:model="family_firstname"  class="block mt-1 w-full" type="text" name="family_firstname"  required autofocus autocomplete="family_firstname" />
            </div>

            <div>
                <x-jet-label for="family_lastname" value="{{ __('Last Name') }}" />
                <x-jet-input id="family_lastname" wire:model="family_lastname"  class="block mt-1 w-full" type="text" name="family_lastname"  autofocus autocomplete="family_lastname" />
            </div>

            <div>
                <x-jet-label for="family_email" value="{{ __('Email') }}" />
                <x-jet-input id="family_email" wire:model="family_email" class="block mt-1 w-full" type="text" name="family_email"   autofocus autocomplete="family_email" />
            </div>

            <div>
                <x-jet-label for="family_phone" value="{{ __('Contact Number') }}" />
                <x-jet-input id="family_phone" wire:model="family_phone" class="block mt-1 w-full" type="text" name="family_phone"   autofocus autocomplete="family_phone" />
            </div>

            <div class="mt-4">
                <x-jet-label for="family_gender_id" value="{{ __('Gender') }}" />
              <select id="family_gender_id" wire:model="family_gender_id" name="family_gender_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                <option value=""  selected>--Select--</option>
                @foreach ($master_gender as $row)
                <option value="{{$row->id}}">{{$row->value}}</option>
                @endforeach
              </select>

            </div>
            <div>
                <x-jet-label for="family_relation_id" value="{{ __('Rate') }}" />
                 <div>
                    <select id="family_relation_id" wire:model="family_relation_id" name="family_relation_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                       
                      <option value="">-Select--</option>
                      @foreach ($master_family_relations as $row)
                        <option value="{{$row->id}}">{{$row->value}}</option>
                        @endforeach
                      
                    </select>
                  </div>

            </div>

            <div>
               <!-- <x-jet-input id="family_color_indicator" wire:model="family_color_indicator" class="block mt-1 w-full" type="text" name="family_color_indicator"   autofocus autocomplete="family_color_indicator" /> -->
            </div>

            <!-- ## Color picker start ##### -->
            <div>
                <style>
                   [x-cloak] {
                       display: none;
                   }
               </style>
               <div x-data="app()" x-cloak>
                   <div class="max-w-sm mx-auto ">
                        
                       <div class="mb-5">
                           <div class="flex items-center">
                               <div>
                                   <x-jet-label for="family_color_indicator" value="{{ __('Color Indicatior') }}" />
                                   <input id="family_color_indicator" wire:model="family_color_indicator" name="family_color_indicator" type="text" class="block mt-1 w-full" placeholder="Pick a color"
                                       lass="border border-transparent shadow px-4 py-2 leading-normal text-gray-700 bg-white rounded-md focus:outline-none focus:shadow-outline"
                                       readonly 
                                       x-model="family_color_indicator">
                               </div>
                               <div class="relative ml-3 mt-8">
                                   <button type="button" @click="isOpen = !isOpen" 
                                       class="w-10 h-10 rounded-full focus:outline-none focus:shadow-outline inline-flex p-2 shadow"
                                       :style="`background: ${family_color_indicator}; color: white`"
                                   >
                                       <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path fill="none" d="M15.584 10.001L13.998 8.417 5.903 16.512 5.374 18.626 7.488 18.097z"/><path d="M4.03,15.758l-1,4c-0.086,0.341,0.015,0.701,0.263,0.949C3.482,20.896,3.738,21,4,21c0.081,0,0.162-0.01,0.242-0.03l4-1 c0.176-0.044,0.337-0.135,0.465-0.263l8.292-8.292l1.294,1.292l1.414-1.414l-1.294-1.292L21,7.414 c0.378-0.378,0.586-0.88,0.586-1.414S21.378,4.964,21,4.586L19.414,3c-0.756-0.756-2.072-0.756-2.828,0l-2.589,2.589l-1.298-1.296 l-1.414,1.414l1.298,1.296l-8.29,8.29C4.165,15.421,4.074,15.582,4.03,15.758z M5.903,16.512l8.095-8.095l1.586,1.584 l-8.096,8.096l-2.114,0.529L5.903,16.512z"/></svg>
                                   </button>
           
                                   <div x-show="isOpen" @click.away="isOpen = false" x-transition:enter="transition ease-out duration-100 transform"
                                       x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                                       x-transition:leave="transition ease-in duration-75 transform"
                                       x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                                       class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg">
                                       <div class="rounded-md bg-white shadow-xs px-4 py-3">
                                           <div class="flex flex-wrap -mx-2">
                                           <template x-for="(color, index) in colors" :key="index">
                                               <div 
                                                   class="px-2"
                                               >
                                                   <template x-if="family_color_indicator === color">	
                                                       <div
                                                           class="w-8 h-8 inline-flex rounded-full cursor-pointer border-4 border-white"
                                                           :style="`background: ${color}; box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.2);`"
                                                       ></div>
                                                   </template>
                                                   
                                                   <template x-if="family_color_indicator != color">
                                                       <div
                                                           @click="family_color_indicator = color"
                                                           @keydown.enter="family_color_indicator = color"
                                                           role="checkbox"
                                                             tabindex="0"
                                                             :aria-checked="family_color_indicator"	
                                                           class="w-8 h-8 inline-flex rounded-full cursor-pointer border-4 border-white focus:outline-none focus:shadow-outline"
                                                           :style="`background: ${color};`"
                                                       ></div>
                                                   </template>
                                               </div>
                                           </template>
                                       </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                        
                   </div>
               </div>
           
               <script>
                   function app() {
                       return {
                           isOpen: false,
                           colors: ['#2196F3', '#009688', '#9C27B0', '#FFEB3B', '#afbbc9', '#4CAF50', '#2d3748', '#f56565', '#ed64a6'],
                           family_color_indicator: '#2196F3'
                       }
                   }
               </script>
            </div>
             <!-- ### end color picker ### -->



            <div class="flex md:justify-between justify-center items-center mt-10">
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                <p class="md:mx-2 text-sm font-light text-gray-400"> Documents </p> 
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
            </div>

            <div>
                <x-jet-label for="file_single" value="{{ __('Single Upload') }}" />
                <x-jet-input id="file_single" wire:model="file_single" class="block mt-1 w-full" type="file" name="file_single" required  autofocus autocomplete="file_single" />
            
                <x-jet-label for="file_single_name" value="{{ __('Name') }}" />
                <x-jet-input id="file_single_name" wire:model="file_single_name" class="block mt-1 w-full" type="text" name="file_single_name"   autofocus autocomplete="file_single_name" />
            </div>

            <div>
                <x-jet-label for="file_multiple" value="{{ __('Multi File Upload') }}" />
                <x-jet-input id="file_multiple" wire:model="file_multiple" class="block mt-1 w-full" type="file" name="file_multiple" multiple   autofocus autocomplete="file_multiple" />
                <x-jet-label for="file_multiple_name" value="{{ __('Name') }}" />
                <x-jet-input id="file_multiple_name" wire:model="file_multiple_name" class="block mt-1 w-full" type="text" name="file_multiple_name"   autofocus autocomplete="file_multiple_name" />
            </div>
            <div>
                <x-jet-label for="expiry_date" value="{{ __('Expiry Date') }}" />
                <x-jet-input id="expiry_date" wire:model="expiry_date" value="1980-10-04" class="block mt-1 w-full" type="text" name="expiry_date"  required autofocus autocomplete="expiry_date" />
            </div>
            <div>
                <x-jet-label for="expiry_before_date" value="{{ __('Before Expiry Date') }}" />
                <x-jet-input id="expiry_before_date" wire:model="expiry_before_date" class="block mt-1 w-full" type="text" name="expiry_before_date"  autofocus autocomplete="expiry_before_date" />
            </div>
            <!--
            <div class="float-left">
                <x-jet-button type="button" wire:click="formShow(2)" class="ml-4">
                    {{ __('Back') }}
                </x-jet-button>
            </div>

            <div class="float-right">
                <x-jet-button type="button" wire:click="formShow(4)" class="ml-4">
                    {{ __('Continue') }}
                </x-jet-button>
            </div>
        -->
            @endif

            @if($form==4 || $form_all==1)
            <div class="flex md:justify-between justify-center items-center mt-10">
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
                <p class="md:mx-2 text-sm font-light text-gray-400"> Login Credentials </p> 
                <div style="height: 1px;" class="bg-gray-300 md:block hidden w-4/12"></div>
            </div>

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" value="test@test.com" wire:model="email" class="block mt-1 w-full" type="email" name="email"  required />
            </div>
            
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" value="password" wire:model="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" value="password" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

        
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button type="submit" class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
            </div>
        
            @endif

        </form>

</div>
</div>
</div>
<script>

      initDOBDatepicker();
      initExpiryDateDatepicker();
      initExpiryBeforeDateDatepicker();
function formSubmit() {
    document.frmRegistration.submit();
}  

window.addEventListener('formSubmit', event => {
    //alert('Name updated to: ' + event.detail.newName);
   // document.frmRegistration.submit();
})

</script>