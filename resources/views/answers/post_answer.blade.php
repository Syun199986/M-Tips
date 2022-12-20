<x-guest-layout>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<title>M-Tips</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	</head>

	<body class="bg-light">
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-white">
				<div class="container-fluid">
					<a class="navbar-brand" href="/">M-Tips</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/">ホーム</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/post_question">質問投稿</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="/my_posted_questions">マイ投稿</a>
							</li>
							<li class="nav-item">
								<form method="POST" action="{{ route('logout') }}">
	                            @csrf
									<a class="nav-link" aria-current="page" href="route('logout')" 
											onclick="event.preventDefault();
	                                           			this.closest('form').submit();">
										ログアウト
									</a>
								</form>
							</li>
						</ul>
					</div>
				</div>
			</nav>
		</header>
		<main>
			<div class="questions container text-center border-gray-300 border-1 rounded-3 mt-5 mb-3 px-4 py-2 bg-white">
				<div class='question'>
					<div class="d-flex justify-content-between">
						<h2 class='title row align-items-start mb-0'>{{ $question->title }}</h2>
					</div>
					<p class="row align-items-start mb-0" style="font-size: 15px; opacity: 0.7;">質問ユーザー：{{ $question->user_name }}</p>
					<p class="row align-items-start" style="font-size: 15px; opacity: 0.7;">投稿日時：{{ $question->created_at }}</p>
					<!--<p class="row align-items-start">音楽カテゴリ：{{ $question->category_id }}</p>-->
					<p class='body row align-items-start text-left' style="font-size: 18px; white-space: pre-wrap;">{{ $question->body }}</p>
					<div class="flex justify-center">
						@if(
							strrpos($question->file_path, '.gif')
							|| strrpos($question->file_path, '.jpeg')
							|| strrpos($question->file_path, '.jpg')
							|| strrpos($question->file_path, '.png')
							|| strrpos($question->file_path, '.bmp')
							|| strrpos($question->file_path, '.svg')
							)
						    <img src="{{ $question->file_path }}">
						@elseif(
							strrpos($question->file_path, '.aac')
							|| strrpos($question->file_path, '.m4a')
							|| strrpos($question->file_path, '.mp1')
							|| strrpos($question->file_path, '.mp2')
							|| strrpos($question->file_path, '.mp3')
							|| strrpos($question->file_path, '.mpg')
							|| strrpos($question->file_path, '.mpeg')
							|| strrpos($question->file_path, '.oga')
							|| strrpos($question->file_path, '.ogg')
							|| strrpos($question->file_path, '.wav')
							|| strrpos($question->file_path, '.wabm')
								)
							<audio controls src="{{ $question->file_path }}">
					            <a href="{{ $question->file_path }}">
					            	Download audio
            					</a>
            				</audio>
						@endif
					</div>
				</div>
			</div>
			<div class="post_answer container border-gray-300 border-1 rounded-3 px-4 py-2 bg-white">
				<form action="/{{ $question->id }}/all_answers/store" method="POST" enctype="multipart/form-data">
				@csrf
	                <div class="mb-3">
	                    <h2 class="form-label">Tipsの投稿</h2>
	                    <textarea class="form-control" name="answer[body]" placeholder="Tipsを入力" rows="3">{{ $answer->body }}</textarea>
	                </div>
		                <div class="d-flex justify-content-between">
							<input class="form-control form-control" id="answer_file" name="answer_file" type="file" accept="image/*,.aac,.m4a,.mp1,.mp2,.mp3,.mpg,.mpeg,.oga,.ogg,.wav,.wabm">
		      				<input type="submit" value="Give Tips!" class="btn btn-warning ml-5"/>
						</div>
		      		<input type="hidden" name="answer[user_name]" value="{{ Auth::user()->name }}"/>
		      		<input type="hidden" name="answer[question_id]" value="{{ $question->id }}"/>
		      		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
		      		<input type="hidden" name="answer_id" value="{{ $answer->id }}"/>
				</form>
				<p class="mb-0" style="font-size: 15px; opacity: 0.7;">画像、音声ファイルを選択</p>
				<input class="btn btn-outline-danger btn-sm mt-2" type="button" id="file_clear" value="ファイル選択解除" onclick="fileClear();"/>
			</div>
		</main>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	</body>
	<script>
		function fileClear(){
		  let qfile = document.getElementById("answer_file");
		  qfile.value = "";
		}
	</script>
</html>
</x-guest-layout>