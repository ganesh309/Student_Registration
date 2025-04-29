<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Fees</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Fees</h2>

        <!-- Select Course and Academic Year -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="course_id">Course</label>
                <select id="course_id" class="form-select" required>
                    <option value="">Select Course</option>
                    @foreach($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="academic_id">Academic Year</label>
                <select id="academic_id" class="form-select" required>
                    <option value="">Select Academic Year</option>
                    @foreach($academicYears as $academic)
                        <option value="{{ $academic->id }}">{{ $academic->academic_year }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <!-- Fees Breakdown (Dynamically Loaded) -->
        <div id="fees-container"></div>

    </div>

    <script>
        // Handle changes in course or academic year
        $('#course_id, #academic_id').change(function () {
            let courseId = $('#course_id').val();
            let academicId = $('#academic_id').val();

            // Only fetch the data if both course and academic year are selected
            if (courseId && academicId) {
                // Send AJAX request to get fees details
                $.ajax({
                    url: '{{ route("fees-details.get-fees-details") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        course_id: courseId,
                        academic_id: academicId
                    },
                    success: function (response) {
                        // Empty the current fees container
                        $('#fees-container').empty();

                        // If there are no fees, show a message
                        if (response.length === 0) {
                            $('#fees-container').html('<p>No fees details found for this course and academic year.</p>');
                        } else {
                            // Otherwise, show the fees details
                            response.forEach(function(fee) {
                                $('#fees-container').append(`
                                    <div class="fees-entry mb-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Fees Head</label>
                                                <input type="text" class="form-control" value="${fee.fees_head.name}" readonly>
                                            </div>
                                            <div class="col-md-5">
                                                <label>Amount</label>
                                                <input type="number" class="form-control fee-amount" value="${fee.amount}" data-fee-id="${fee.id}">
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-danger remove-fee">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                `);
                            });
                        }
                    }
                });
            }
        });

        // Handle the removal of a fee entry
        $(document).on('click', '.remove-fee', function () {
            $(this).closest('.fees-entry').remove();
        });

        // Handle the submission of updated fees
        $('#submitFees').click(function () {
            let updatedFees = [];
            $('.fee-amount').each(function () {
                updatedFees.push({
                    fee_id: $(this).data('fee-id'),
                    amount: $(this).val()
                });
            });

            // Send updated fees via AJAX (you can create a route to save the updated data)
            $.ajax({
                url: '{{ route("fees-details.update") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    updated_fees: updatedFees
                },
                success: function(response) {
                    alert('Fees updated successfully!');
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
