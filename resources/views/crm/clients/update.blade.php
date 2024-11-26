<!DOCTYPE html>
<html lang="pl">
@include('layouts.head', ['title' => 'Update client'])
<body class="bg-gray-100">

<div class="flex h-screen" x-data="{ sidebarOpen: false }">
    @include('layouts.sidebar')

    <div class="flex-1 flex flex-col">
        @include('layouts.header')

        <main class="flex-1 p-6 overflow-y-auto">
            <div>
                @include('layouts.flash-messages')
            </div>

            <div class="w-full bg-white shadow-md rounded-lg mb-3">
                <div class="p-6 flex justify-between items-center">
                    <p class="text-xl">Update client: {{ $client->full_name }}</p>
                    <a href="{{ url()->previous() }}">
                        <button class="bg-gray-500 text-white font-bold uppercase text-xs px-4 py-2 rounded shadow hover:shadow-md outline-none focus:outline-none ease-linear transition-all duration-150" type="button">
                            Back
                        </button>
                    </a>
                </div>
            </div>

            <div class="w-full bg-white shadow-md rounded-lg">
                <div class="p-6">
                    <form action="{{ route('clients.update', $client) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-2 gap-6">
                            <div>
                                @include('layouts.components.forms.input', [
                                    'name' => 'Full name',
                                    'inputId' => 'full-name',
                                    'inputName' => 'full_name',
                                    'inputType' => 'text',
                                    'inputValue' => $client->full_name,
                                    'inputRequired' => true,
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'Phone',
                                    'inputId' => 'phone',
                                    'inputName' => 'phone',
                                    'inputType' => 'number',
                                    'inputValue' => $client->phone,
                                    'inputRequired' => true
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'Budget',
                                    'inputId' => 'budget',
                                    'inputName' => 'budget',
                                    'inputType' => 'text',
                                    'inputValue' => $client->budget,
                                    'inputRequired' => true
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'City',
                                    'inputId' => 'city',
                                    'inputName' => 'city',
                                    'inputType' => 'text',
                                    'inputValue' => $client->city,
                                    'inputRequired' => true
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'Country',
                                    'inputId' => 'country',
                                    'inputName' => 'country',
                                    'inputType' => 'text',
                                    'inputValue' => $client->country,
                                    'inputRequired' => true
                                ])
                            </div>

                            <div>
                                @include('layouts.components.forms.input', [
                                    'name' => 'Email address',
                                    'inputId' => 'email',
                                    'inputName' => 'email',
                                    'inputType' => 'email',
                                    'inputValue' => $client->email,
                                    'inputRequired' => true,
                                ])

                                @include('layouts.components.forms.select', [
                                    'name' => 'Section',
                                    'inputId' => 'section',
                                    'inputName' => 'section',
                                    'inputRequired' => true,
                                    'inputValue' => $client->section,
                                    'options' => [
                                        (object)['id' => 'transport', 'name' => 'Transport'],
                                        (object)['id' => 'logistic', 'name' => 'Logistic'],
                                        (object)['id' => 'finances', 'name' => 'Finances']
                                    ]
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'Location',
                                    'inputId' => 'location',
                                    'inputName' => 'location',
                                    'inputType' => 'text',
                                    'inputValue' => $client->location,
                                    'inputRequired' => true
                                ])

                                @include('layouts.components.forms.input', [
                                    'name' => 'ZIP',
                                    'inputId' => 'zip',
                                    'inputName' => 'zip',
                                    'inputType' => 'text',
                                    'inputValue' => $client->zip,
                                    'inputRequired' => true
                                ])
                            </div>
                        </div>

                        <div class="flex justify-end border-t border-gray-200">
                            <button type="submit" class="bg-blue-500 mt-3 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Update client</button>
                        </div>
                    </form>
                </div>
            </div>

        </main>

        @include('layouts.footer')
    </div>
</div>

</body>
</html>