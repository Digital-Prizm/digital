
<div>
  <header class="bg-white shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manage Salutation 
        </h2>
    </div>
    
</header>

@include('includes.util')

<div>
@if($error || count($errors) > 0)
<div class="rounded-md bg-red-50 p-4 alert">
<div class="flex">
<div class="flex-shrink-0">
<!-- Heroicon name: solid/x-circle -->
<svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
</svg>
</div>
<div class="ml-3">
<h3 class="text-sm font-medium text-red-800">
There were some errors with your submission   
</h3>
<div class="mt-2 text-sm text-red-700">
<ul class="list-disc pl-5 space-y-1">
@if($error!="")
  <li>
  {{ $error }}
  </li>
  @endif
   @if (count($errors) > 0)
        @foreach ($errors->all() as $this_error)
          <li>{{ $this_error }}</li> 
        @endforeach
  @endif

</ul>
</div>
</div>
</div>
</div>
@endif
</div>

<div class="flex mx-10">
  <div class="w-full max-w-xs mt-6">
    <form name="frmSalutation" class="bg-white rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        <input type="hidden" name="edit_id" id="edit_id" wire:modal="edit_id" />
       
       
      <div class="mb-4">
        <label class="block text-gray-600 text-sm font-semibold mb-2" for="value">
          Salutation
        </label>
        <input
          class="bg-gray-100 appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
          id="value" name="value" wire:model="value"
          type="text" required 
          placeholder="Enter salutation"
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