<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Log In
    </x-slot:heading>

    <x-slot:title>
        Log In
    </x-slot:title>

<form method="POST" action="/login">
  <!-- the csrf directive will generate a token to prevent cross-site request forgery attacks and put it in a hidden input field. When the form is posted, the token is compared to the one in your session for validation -->
  
  @csrf 
  <div class="space-y-12">

    <div class="border-b border-gray-900/10 pb-12">

      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <x-form-field>

            <x-form-label for="email">Email</x-form-label>

            <div class="mt-2">
                <!-- in the value, using the old() method to repopulate the field with the value that was submitted in the previous request. This is useful when the form submission fails and the user is redirected back to the form with the old input values. Rememeber: when we don't want to pass a string to the attribute, we must prefix the attribute name with a colon. -->
                <x-form-input name="email" id="email" type="email" :value="old('email')" required></x-form-input>
                
                <x-form-error name="email" />         

            </div>

        </x-form-field>

        <x-form-field>

          <x-form-label for="password">Password</x-form-label>

          <div class="mt-2">

            <x-form-input name="password" id="password" type="password" required></x-form-input>

            <x-form-error name="password" />

          </div>

        </x-form-field>

      </div>

    </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">

    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>

    <x-form-button>Log In</x-form-button>    

  </div>

</form>


</x-layout>