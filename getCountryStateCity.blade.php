
<div class="col-lg-12 col-md-12 col-sm-12">
    <div class="form-group">
        <label>Country<i class="req">*</i></label>
        <select id="country" class="form-control select2">
            <option value="">Select Country</option>
            @foreach ($countries as $country)
                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="form-group">
        <label>State<i class="req">*</i></label>
        <select id="state" class="form-control select2">
            <option value="">Select State</option>
        </select>
    </div>
</div>

<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="form-group">
        <label>Town/City<i class="req">*</i></label>
        <select id="town" class="form-control select2">
            <option value="">Select City</option>
        </select>
    </div>
</div>

@section('frontend_footer')
    <script>
        $(document).ready(function() {
            // Fetch states when a country is selected
            $('#country').on('change', function() {
                const countryId = $(this).val();
                console.log('Selected Country ID:', countryId);

                // Reset states and cities dropdowns
                $('#state').empty().append('<option value="">Select State</option>');
                $('#town').empty().append('<option value="">Select City</option>');

                if (countryId) {
                    $.ajax({
                        url: `/states/${countryId}`,
                        type: 'GET',
                        success: function(data) {
                            console.log('States:', data);
                            data.forEach(state => {
                                $('#state').append(
                                    `<option value="${state.id}">${state.name}</option>`
                                    );
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching states:', xhr.responseText);
                        }
                    });
                }
            });

            // Fetch cities when a state is selected
            $('#state').on('change', function() {
                const stateId = $(this).val();
                console.log('Selected State ID:', stateId);

                // Reset cities dropdown
                $('#town').empty().append('<option value="">Select City</option>');

                if (stateId) {
                    $.ajax({
                        url: `/cities/${stateId}`,
                        type: 'GET',
                        success: function(data) {
                            console.log('Cities:', data);
                            data.forEach(city => {
                                $('#town').append(
                                    `<option value="${city.id}">${city.name}</option>`
                                    );
                            });
                        },
                        error: function(xhr) {
                            console.error('Error fetching cities:', xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
@endsection
