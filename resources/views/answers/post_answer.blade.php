<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

	<head>
		<meta charset="utf-8">
		<title>M-Tips</title>
		<!-- Fonts -->
		<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
			integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	</head>

	<body>
		<header>
			<nav class="navbar navbar-expand-lg navbar-light bg-light">
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
								<a class="nav-link" aria-current="page" href="#">ログアウト</a>
							</li>
						</ul>
						<select class="form-select w-auto" aria-label="Default select example">
							<option selected>▼カテゴリ選択</option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
						</select>
						<form class="d-flex">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success" type="submit">Search</button>
						</form>
					</div>
				</div>
			</nav>
		</header>
		<main>
				<div class="questions container text-center border border-dark border-2 rounded-3 my-3">
					<div class='question'>
						<h2 class='title row align-items-start'>{{ $question->title }}</h2>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">{{ $question->created_at }}</p>
						</div>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">音楽カテゴリ：{{ $question->category_id }}</p>
						</div>
						<p class='body row align-items-start'>{{ $question->body }}</p>
						@if(strrpos($question->file_path, '.png'))
						    <img src="{{ $question->file_path }}">
						@elseif(strrpos($question->file_path, '.mp3'))
							<audio controls src="{{ $question->file_path }}">
					            <a href="{{ $question->file_path }}">
					            	Download audio
            					</a>
            				</audio>
						@endif						
					</div>
				</div>
			<div class="post_answer container border border-dark border-2 rounded-3 my-3" id="answer_form">
				<form action="/{{ $question->id }}/all_answers/store" method="POST" enctype="multipart/form-data">
				@csrf
	                <div class="mb-3">
	                    <h2 class="form-label">回答文</h2>
	                    <textarea class="form-control" name="answer[body]" rows="3" placeholder="回答文を入力" value="{{ old('answer.body') }}"></textarea>
	                    <p class="title__error" style="color:red">{{ $errors->first('answer.body') }}</p>
	                </div>
	                <div class="d-flex justify-content-between">
	      				<input type="file" name="answer_file" class="" id="answer_file"/>
	      				<input type="submit" value="投稿する" class=""/>
					</div>
		      		<input type="hidden" name="answer[question_id]" value="{{ $question->id }}"/>
		      		<input type="hidden" name="user_id" value="{{ Auth::user()->id }}"/>
		      		<input type="hidden" name="answer_id" value="{{ $answer->id }}"/>
				</form>
				<input type="button" id="file_clear" value="ファイル選択解除" onclick="fileClear();"/>
			</div>
		</main>
	</body>
	<script>
		function fileClear(){
		  let qfile = document.getElementById("answer_file");
		  qfile.value = "";
		}
	</script>
</html>