<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Quiz untuk {{ $course->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-6 bg-gray-50 font-sans">
    <h2 class="text-3xl font-bold text-indigo-700 mb-6">Daftar Quiz: {{ $course->title }}</h2>

    @if($quizzes->count())
        <div class="space-y-6">
            @foreach($quizzes as $quiz)
                <div class="bg-white p-6 rounded-lg shadow">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        {{ $loop->iteration }}. {{ $quiz->question }}
                    </h3>

                    <ul class="space-y-2 pl-4">
                        <li class="@if(strtoupper($quiz->answer) === 'A') font-bold text-green-600 @endif">
                            A. {{ $quiz->option_a }}
                        </li>
                        <li class="@if(strtoupper($quiz->answer) === 'B') font-bold text-green-600 @endif">
                            B. {{ $quiz->option_b }}
                        </li>
                        <li class="@if(strtoupper($quiz->answer) === 'C') font-bold text-green-600 @endif">
                            C. {{ $quiz->option_c }}
                        </li>
                        <li class="@if(strtoupper($quiz->answer) === 'D') font-bold text-green-600 @endif">
                            D. {{ $quiz->option_d }}
                        </li>
                    </ul>

                    <p class="mt-3 text-sm text-gray-500">
                        Jawaban benar:
                        <span class="font-semibold text-indigo-700 uppercase">
                            {{ strtoupper($quiz->correct_answer) }}
                        </span>
                    </p>
                    <p class="mt-3 text-sm text-gray-500">
                        Jawaban Muncul di Quiz Detik:
                        <span class="font-semibold text-indigo-700 uppercase">
                            {{ strtoupper($quiz->appear_time) }}
                        </span>
                    </p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-500">Belum ada quiz untuk course ini.</p>
    @endif
</body>
</html>

