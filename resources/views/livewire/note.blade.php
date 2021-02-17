
<div class="flex flex-col w-0 flex-1 overflow-hidden">
  
    <main class="flex-1 relative z-0 overflow-y-auto focus:outline-none" tabindex="0">
      <!-- Page title & actions -->
      <div class="border-b border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">
        <div class="flex-1 min-w-0">
          <h1 class="text-lg font-medium leading-6 text-gray-900 sm:truncate">
            Note
          </h1>
        </div>
      </div>
	  <div>data= {{ $tt }}</div>
      <!-- Pinned projects -->
     <!-- ######### MAIN content ######################## -->
   <div class="border-b border-gray-200  sm:flex  sm:items-center sm:justify-between  lg:px-8">
			  	<div class=" w-full block">
				
				
			<div class="block flow-root">
				<div class="pt-5  sm:space-y-5  w-6/12 clear-right">
				  <div>
					<h3 class="text-lg leading-6 font-medium text-gray-900">
					  Note Information
					</h3>
					
				  </div>
				  	  
				  <input type="hidden" name="edit_id" id="edit_id" wire:modal="edit_id" />
				  
				  <div class="float-left w-6/12 flex-initial">
				  <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
				  <div class="mt-1">
					<input type="text" name="title" id="title" wire:model="title" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter title here">
				  </div>
				</div>
				
				<div class="float-left w-6/12 flex-initial mt-8">
				  <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
				  <div class="mt-1">
					<textarea  name="description" id="description" wire:model="description" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="Enter description here"></textarea>
				  </div>
				</div>
				
				
				<div class="float-left flex-initial">
				<div class="flex justify-end">
				  
				  <button type="button" wire:click="createNote()" class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 space-x-4">
					Save
				  </button>&nbsp;
				  <button type="reset" wire:click="resetForm()" class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 space-x-4">
					Clear
				  </button>
				</div>
				</div>
				  
				</div>
			</div>
				
			
			
			
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
										@foreach ($errors->all() as $error)
											<li>{{ $error }}</li> 
										@endforeach
							@endif
				
						</ul>
					  </div>
					</div>
				  </div>
				</div>
			@endif
			
			 <div>
				@if (session()->has('message'))
					
					<!-- This example requires Tailwind CSS v2.0+ -->
					<div class="rounded-md bg-green-50 p-4 alert">
					  <div class="flex">
						<div class="flex-shrink-0">
						  <!-- Heroicon name: solid/check-circle -->
						  <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
							<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
						  </svg>
						</div>
						<div class="ml-3">
						  <p class="text-sm font-medium text-green-800">
							{{ session('message') }}
						  </p>
						</div>
						<div class="ml-auto pl-3">
						  <div class="-mx-1.5 -my-1.5">
							<button class="inline-flex bg-green-50 rounded-md p-1.5 text-green-500 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
							  <span class="sr-only">Dismiss</span>
							  <!-- Heroicon name: solid/x -->
							  <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
								<path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
							  </svg>
							</button>
						  </div>
						</div>
					  </div>
					</div>

				@endif
			</div>
	
			
			@include('includes.util')
			
				</div>
			
			
			
			
			
			
			
			

			  <div class="pt-5">
				
			  </div>
		
			</div>
			
			

			
			<div style="clear:both;"></div>
			
			<!-- ##### LISTING started here -->
 <div class="border-gray-200 px-4 py-4 sm:flex sm:items-center sm:justify-between sm:px-6 lg:px-8">			
<ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
@foreach ($data as $note)
  <li class="col-span-1 bg-white rounded-lg shadow divide-y divide-gray-200">
    <div class="w-full flex items-center justify-between p-6 space-x-6">
      <div class="flex-1 truncate">
        <div class="flex items-center space-x-3">
          <h3 class="text-gray-900 text-sm font-medium truncate">{{ $note->title}}</h3>
          <span class="flex-shrink-0 inline-block px-2 py-0.5 text-green-800 text-xs font-medium bg-green-100 rounded-full">User</span>
        </div>
        <p class="mt-1 text-gray-500 text-sm truncate">{{ $note->description}}</p>
      </div>
     <!-- <img class="w-10 h-10 bg-gray-300 rounded-full flex-shrink-0" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60" alt=""> -->
	  
	  <svg  class="w-5 h-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
</svg>

    </div>
    <div>
      <div class="-mt-px flex divide-x divide-gray-200">
        <div class="w-0 flex-1 flex">
          <a href="#" class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500">
            <!-- Heroicon name: solid/mail -->
           			
			<svg  class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
  <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
  <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
</svg>


            <span class="ml-3" wire:click="edit({{$note->id}})" >Edit</span>
          </a>
        </div>
        <div class="-ml-px w-0 flex-1 flex">
          <a href="#" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500">
            <!-- Heroicon name: solid/phone -->
          			
			<svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM7 9a1 1 0 000 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
</svg>

            <span class="ml-3" wire:click="destroy({{$note->id}})" >Delete</span>
          </a>
        </div>
      </div>
    </div>
  </li>
@endforeach

</ul>

	
   </div> 



<!-- #### end ####################### -->
    </main>
</div>




<!-- This example requires Tailwind CSS v2.0+ -->
<div class="fixed z-10 inset-0 overflow-y-auto hidden">
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <!--
      Background overlay, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 transition-opacity" aria-hidden="true">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>

    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <!--
      Modal panel, show/hide based on modal state.

      Entering: "ease-out duration-300"
        From: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
        To: "opacity-100 translate-y-0 sm:scale-100"
      Leaving: "ease-in duration-200"
        From: "opacity-100 translate-y-0 sm:scale-100"
        To: "opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
    -->
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
            <!-- Heroicon name: outline/exclamation -->
            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Deactivate account
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Are you sure you want to deactivate your account? All of your data will be permanently removed. This action cannot be undone.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
          Deactivate
        </button>
        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
          Cancel
        </button>
      </div>
    </div>
  </div>
</div>
<script>
/*
	function clearAll() {
		$(".alert").hide();
	}
document.addEventListener('livewire:load', function () {
	
	
Livewire.on("clearall", () => {
		
	});

	
}) */
</script>	

<!-- This example requires Tailwind CSS v2.0+ -->
