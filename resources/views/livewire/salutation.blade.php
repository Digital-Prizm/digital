
<div>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Salutation 
        </h2>
    </div>
    
</header>

@include('includes.util')

<div class="flex mx-10">
  <div class="w-full max-w-xs mt-6">
    <form name="frmSalutation" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id" wire:modal="edit_id" />
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
       
      <div class="mb-4">
        <label class="block text-gray-600 text-sm font-semibold mb-2" for="value">
          Salutation
        </label>
        <input
          class="bg-gray-100 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="value" name="value" wire:model="value"
          type="text" required 
          placeholder="Enter gender"
        />
      </div>

      <div class="flex items-center justify-between">
        <button type="button"  wire:click="create()"  class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
          Save 
        </button>
        <a  wire:click="resetForm()"  class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="#">
          cancel
        </a>
      </div>
    </form>
   
</div>
  <!-- component -->
<div class="w-2/3 mx-auto">
    <div class="bg-white shadow-md rounded my-6">
      <table class="text-left w-full border-collapse"> <!--Border collapse doesn't work on this site yet but it's available in newer tailwind versions -->
        <thead>
          <tr>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Salutation</th>
            <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-sm text-grey-dark border-b border-grey-light">Actions</th>
          </tr>
        </thead>
        <tbody>
          @if(isset($data))  
          @foreach($data as $row) 
          <tr class="hover:bg-grey-lighter">
            <td class="py-4 px-6 border-b border-grey-light">{{ $row->value }}</td>
            <td class="py-4 px-6 border-b border-grey-light">
              <a  wire:click="editForm({{$row->id}})" class="text-white-lighter font-bold py-1 px-3 cursor-pointer rounded text-xs bg-green text-white bg-blue-500 hover:bg-green-dark">Edit</a>
              <a  onclick="javascript:  @this.confirm_function='destroy({{$row->id}})'; @this.confirm_content='Are you sure you want to Remove gender'; @this.confirm_modal=1; " class="text-grey-lighter font-bold py-1 px-3 cursor-pointer rounded text-xs bg-blue bg-red-500 text-white hover:bg-blue-dark">Remove</a>
            </td>
          </tr>
          @endforeach
          @endif
          
        </tbody>
      </table>
    </div>
  </div>

</div>
</div>