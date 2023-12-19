<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Editing a plan') }}
            </h2>

            <form action="{{route('admin.plans.destroy', $plan)}}" method="POST">
                @csrf
                @method('DELETE')

                <x-secondary-button type="submit" class="max-w-fit">
                    <span>Delete X</span>
                </x-secondary-button>
            </form>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white border rounded-lg shadow-sm p-7 border-neutral-200/60">
                <div class="block mb-3">
                    <h5 class="text-xl font-bold leading-none tracking-tight text-neutral-900">Editing new plan</h5>
                </div>
                <p class="mb-4 text-neutral-500">Leave the fields unchanged if you don't want to update
                </p>

                <form method="post" action="{{route('admin.plans.update', $plan)}}" id="store">
                    @csrf
                    @method('PATCH')
                    <div class="form-inputs my-2 flex flex-col gap-4">
                        <div class="flex flex-col">
                            <x-input-label for="name" value="Name" />
                            <x-text-input name="name" label="name" placeholder="Eg. John Doe" required
                                :value="$plan->name" />
                            @error('name')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <div class="flex flex-col">
                            <x-input-label for="description" value="Description" />
                            <x-text-input name="description" label="Description"
                                placeholder="Eg. This plan is for small businesses" required
                                :value="$plan->description" />
                            @error('description')
                            <x-input-error :messages="$message"> </x-input-error>
                            @enderror
                        </div>

                        <input type="hidden" name="features" id="featuresInput">

                        <x-input-label for="features" value="Features" />
                        <div id="featuresContainer">
                            <!-- Features will be added dynamically here -->
                            @foreach ($plan->features as $feature => $description)
                            <div class="mb-2 flex gap-1">
                                <x-text-input type="text" name="featureKey[]" placeholder="Feature Name"
                                    :value="$feature" required>
                                </x-text-input>
                                <x-text-input type="text" name="featureValue[]" placeholder="Feature Description"
                                    :value="$description" required>
                                </x-text-input>
                                <x-secondary-button type="button" onclick="removeFeatureField(this)">Remove
                                </x-secondary-button>
                            </div>
                            @endforeach
                        </div>
                        @error('features')
                        <x-input-error :messages="$message"> </x-input-error>
                        @enderror

                        <x-secondary-button class="w-max" type="button" onclick="addFeatureField()">Add Feature +
                        </x-secondary-button>


                        <x-primary-button type="button" onclick="submitForm()" class="max-w-fit">
                            <span>Edit plan &rarr;</span>
                        </x-primary-button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <script>
        function addFeatureField() {
          var featuresContainer = document.getElementById('featuresContainer');

          var featureInput = document.createElement('div');
          featureInput.classList.add('feature-input', 'mb-2', 'flex', 'gap-1');

          featureInput.innerHTML = `
            <x-text-input type="text" name="featureKey[]"  placeholder="Feature Name" required></x-text-input>
            <x-text-input type="text" name="featureValue[]" placeholder="Feature Description" required></x-text-input>
            <x-secondary-button type="button" onclick="removeFeatureField(this)">Remove</x-secondary-button>
          `;

          featuresContainer.appendChild(featureInput);
        }

        function removeFeatureField(button) {
          var featureInput = button.parentNode;
          featureInput.parentNode.removeChild(featureInput);
        }

        function submitForm() {
          var form = document.getElementById('store');


          var features = [];
          var featureKeyInputs = form.querySelectorAll('input[name="featureKey[]"]');
          var featureValueInputs = form.querySelectorAll('input[name="featureValue[]"]');


            for (var i = 0; i < featureKeyInputs.length; i++) {
                var key = featureKeyInputs[i].value.trim();
                var value = featureValueInputs[i].value.trim();

                if (key !== '' && value !== '') {
                features.push({ key: key, value: value });
                }
            }
          // Include features in your AJAX request or form submission
          console.log('Plan Name:', form.elements['name'].value);
          console.log('Plan Description:', form.elements['description'].value);
          console.log('Features:', features);

          document.getElementById('featuresInput').value = JSON.stringify(features);

          form.submit();
        }

        document.addEventListener('DOMContentLoaded', function () {
          addFeatureField();
        });
    </script>

</x-app-layout>