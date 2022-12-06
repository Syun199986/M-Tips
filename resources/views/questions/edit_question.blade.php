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
			<div class="edit_question container border-gray-300 border-1 rounded-3 mt-5 px-4 py-2 bg-white">
                <form action="/questions/{{ $question->id }}" method="POST" enctype="multipart/form-data" id="text_form">
                	@csrf
                	@method('PUT')
	                <div class="mb-3">
	                    <h2 class="form-label">質問タイトル</h2>
				        <div class="d-flex flex-row">
		                    <input form="text_form" type="text" class="form-control" name="question[title]" value="{{ $question->title }}">
	                    </div>
	                </div>
	                <div class="mb-3">
	                    <h2 class="form-label">質問文</h2>
	                    <textarea form="text_form" class="form-control" name="question[body]" rows="3">{{ $question->body }}</textarea>
	                </div>
						@if($question->file_path == NULL)
			                <div class="d-flex justify-content-between">
								<input class="form-control form-control" id="question_file" name="question_file" type="file" accept="image/*,.aac,.m4a,.mp1,.mp2,.mp3,.mpg,.mpeg,.oga,.ogg,.wav,.wabm">
			      				<input type="submit" value="編集を完了" class="btn btn-primary ml-5"/>
							</div>
							<p class="mb-0" style="font-size: 15px; opacity: 0.7;">画像、音声ファイルを選択</p>
							<input class="btn btn-outline-danger btn-sm mt-2" type="button" id="file_clear" value="ファイル選択解除" onclick="fileClear();"/>
						@else
		                	<div class="d-flex justify-content-between">
								<button class="btn btn-outline-danger btn-sm" type="submit" formaction="/questions/{{ $question->id }}/delete_file" id="delete_file">
									ファイルを削除
								</button>								
			      				<input type="submit" value="編集を完了" class="btn btn-primary ml-5"/>
							</div>
							<div class="my-3">
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
						@endif
                	</form>
				</div>
			</div>
		</main>
	</body>
	<script>
		function fileClear(){
		  let qfile = document.getElementById("question_file");
		  qfile.value = "";
		}
	</script>
</html>
</x-guest-layout>