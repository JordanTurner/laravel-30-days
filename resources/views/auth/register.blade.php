<x-layout>

    <!-- named slot. We can access the content in this slot in the layout.blade.php component using $heading  -->
    <x-slot:heading>
        Register
    </x-slot:heading>

    <x-slot:title>
        Register
    </x-slot:title>

<form method="POST" action="/register">
  <!-- the csrf directive will generate a token to prevent cross-site request forgery attacks and put it in a hidden input field. When the form is posted, the token is compared to the one in your session for validation -->
  
  @csrf 
  <div class="space-y-12">

    <div class="border-b border-gray-900/10 pb-12">

      <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

        <x-form-field>

            <x-form-label for="first_name">First Name</x-form-label>

            <div class="mt-2">

                <x-form-input name="first_name" id="first_name" required></x-form-input>
                
                <x-form-error name="first_name" />         

            </div>

        </x-form-field>      

        <x-form-field>

            <x-form-label for="last_name">Last Name</x-form-label>

            <div class="mt-2">

                <x-form-input name="last_name" id="last_name" required></x-form-input>
                
                <x-form-error name="last_name" />         

            </div>

        </x-form-field>
        
        <x-form-field>

            <x-form-label for="email">Email</x-form-label>

            <div class="mt-2">

                <x-form-input name="email" id="email" placeholder="user@example.com" type="email" required></x-form-input>
                
                <x-form-error name="email" />         

            </div>

        </x-form-field>

        <x-form-field>

          <x-form-label for="password">Password</x-form-label>

          <div class="mt-2">

            <x-form-input name="password" id="password" placeholder="min 8 characters" type="password" required></x-form-input>

            <x-form-error name="password" />

          </div>

        </x-form-field>

        <x-form-field>

            <x-form-label for="password_confirmation">Confirm Password</x-form-label>

            <div class="mt-2">

            <x-form-input name="password_confirmation" id="password_confirmation" placeholder="min 8 characters" type="password" required></x-form-input>

            <x-form-error name="password_confirmation" />

            </div>

        </x-form-field>

      </div>

    </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">

    <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>

    <x-form-button>Register</x-form-button>    

  </div>

</form>


</x-layout>