
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
<link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>
@vite(['resources/css/app.css', 'resources/js/app.js'])  -->

<div class="container mt-5">
    <div class="card mb-4 bg-transparent" style="border: none;">
        <div class="card-header bg-transparent text-black" style="border: none;">
            <h2 class="mb-0">Profile</h2>
        </div>
        <div class="card-body bg-transparant">
            <div class="d-flex align-items-start bg-transparent">
                <img
                    src="{{ $user->profile_image ?? asset('images/rawr.jpg') }}"
                    alt="Profile Image"
                    class="rounded-circle me-3 mb-3"
                    style="width: 150px; height: 150px; object-fit: cover;">
                <div class="mt-4">
                    <p class="mb-1"><strong>Name:</strong> {{ $user->name }}</p>
                    <p class="mb-1"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="mb-0"><strong>User Type:</strong> {{ $user->usertype }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Buttons moved outside the profile card -->
    <div class="d-flex justify-content-left mb-4">
        <!-- <a href="{{ route('profile.edit') }}" class="btn btn-primary me-2">Edit</a> -->
        <form action="{{ route('profile.edit') }}" method="GET">

            <button type="submit" class="btn btn-primary me-2">Edit</button>
        </form>
        <form action="{{ route('profile.destroy') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete your account?')">Delete Akun</button>
        </form>
    </div>
</div>

    <!-- Courses Section -->
    <div class="card bg-transparent" style="border: none;">
        <div class="card-header bg-transparent border-none text-black" style="border: none;">
            <h5 class="mb-0">Course</h5>
        </div>
        <div class="card-body">
            @if($courses->isEmpty())
                <p class="text-muted">You haven't purchased any courses yet.</p>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                            <th>Mentor</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($courses as $index => $course)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td><img src="{{ $course->image_url }}" alt="{{ $course->name }}" class="img-fluid" style="max-width: 100px; height: auto;"></td>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>Rp. {{ number_format($course->price, 2, ',', '.') }}</td>
                                <td>{{ $course->mentor ? $course->mentor->name : 'No mentor assigned' }}</td>
                                <td><a href="{{ route('courses.watch', $course->id) }}" class="btn btn-primary btn-sm">Watch</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
