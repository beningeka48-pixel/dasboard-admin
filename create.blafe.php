@if(auth()->user()->role === 'super_admin')
    @extends('layouts.superadmin')
@else
    @extends('layouts.app')
@endif

@section('title', 'Add NU Activity - KracakNu')
@section('page-title', 'Add NU Activity')
@section('page-description', 'Create a new NU activity or community event.')

@section('content')

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        {{-- ERROR --}}

        @if($errors->any())

            <div class="alert alert-danger">

                <strong>Please check the following errors:</strong>

                <ul class="mb-0 mt-2">

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form action="{{ route('nu_activities.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf


            {{-- TITLE --}}

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Activity Title
                </label>

                <input type="text"
                       name="title"
                       class="form-control"
                       value="{{ old('title') }}"
                       placeholder="Enter activity title"
                       required>

            </div>


            {{-- DESCRIPTION --}}

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Description
                </label>

                <textarea name="description"
                          class="form-control"
                          rows="5"
                          placeholder="Enter activity description">{{ old('description') }}</textarea>

            </div>


            <div class="row">

                {{-- CATEGORY --}}

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Category
                    </label>

                    <select name="category"
                            class="form-select">

                        <option value="">
                            -- Select Category --
                        </option>

                        <option value="Pengajian">
                            Pengajian
                        </option>

                        <option value="Keagamaan">
                            Keagamaan
                        </option>

                        <option value="Sosial">
                            Sosial
                        </option>

                        <option value="Pendidikan">
                            Pendidikan
                        </option>

                        <option value="Pemuda">
                            Pemuda NU
                        </option>

                        <option value="Kesehatan">
                            Kesehatan
                        </option>

                        <option value="Lainnya">
                            Lainnya
                        </option>

                    </select>

                </div>


                {{-- DATE --}}

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Activity Date
                    </label>

                    <input type="date"
                           name="activity_date"
                           class="form-control"
                           value="{{ old('activity_date') }}">

                </div>

            </div>


            <div class="row">

                {{-- LOCATION --}}

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Location
                    </label>

                    <input type="text"
                           name="location"
                           class="form-control"
                           value="{{ old('location') }}"
                           placeholder="Enter activity location">

                </div>


                {{-- ORGANIZER --}}

                <div class="col-md-6 mb-3">

                    <label class="form-label fw-semibold">
                        Organizer
                    </label>

                    <input type="text"
                           name="organizer"
                           class="form-control"
                           value="{{ old('organizer') }}"
                           placeholder="Enter organizer">

                </div>

            </div>


            {{-- STATUS --}}

            <div class="mb-3">

                <label class="form-label fw-semibold">
                    Status
                </label>

                <select name="status"
                        class="form-select"
                        required>

                    <option value="planned">
                        Planned
                    </option>

                    <option value="ongoing">
                        Ongoing
                    </option>

                    <option value="completed">
                        Completed
                    </option>

                    <option value="cancelled">
                        Cancelled
                    </option>

                </select>

            </div>


            {{-- IMAGE --}}

            <div class="mb-4">

                <label class="form-label fw-semibold">
                    Activity Image
                </label>

                <input type="file"
                       name="image"
                       class="form-control"
                       accept="image/*">

                <small class="text-muted">
                    Maximum 2MB. JPG, JPEG, PNG, or WEBP.
                </small>

            </div>


            {{-- BUTTON --}}

            <button type="submit"
                    class="btn btn-primary">

                <i class="bi bi-save"></i>

                Save Activity

            </button>


            <a href="{{ route('nu_activities.index') }}"
               class="btn btn-secondary">

                Cancel

            </a>

        </form>

    </div>

</div>

@endsection