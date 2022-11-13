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
					<a class="navbar-brand" href="/home">M-Tips</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse"
						data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
						aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav me-auto mb-2 mb-lg-0">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="/home">ホーム</a>
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
			<div class="d-flex flex-row-reverse">
				<select class="form-select w-auto mx-2 my-3" aria-label="Default select example">
					<option selected>▼並べ替え</option>
					<option value="1">新着順</option>
					<option value="2">気になる!が多い順</option>
					<option value="3">回答数順</option>
				</select>
			</div>
			@foreach ($questions as $question)
				<div class="questions container text-center border border-dark border-2 rounded-3 mb-3">
					<div class='question'>
						<h2 class='title row align-items-start'>{{ $question->title }}</h2>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">{{ $question->created_at }}</p>
							<a href="/questions/{{ $question->id }}/edit_question">質問の編集</a>
						</div>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">音楽カテゴリ：{{ $question->category_id }}</p>
							<form action="/home/{{ $question->id }}" id="form_{{ $question->id }}" method="post">
								@csrf
								@method('DELETE')
								<a href="#" onclick="deleteQuestion({{ $question->id }})" style="color:red">質問の削除</a>
							</form>
						</div>
						<p class='body row align-items-start'>{{ $question->body }}</p>
						
						@if(file_exists(public_path().'/storage/question_file/'. $question->id .'.jpg'))
						    <img src="/storage/question_file/{{ $question->id }}.jpg">
						@elseif(file_exists(public_path().'/storage/question_file/'. $question->id .'.jpeg'))
						    <img src="/storage/question_file/{{ $question->id }}.jpeg">
						@elseif(file_exists(public_path().'/storage/question_file/'. $question->id .'.png'))
						    <img src="/storage/question_file/{{ $question->id }}.png">
						@elseif(file_exists(public_path().'/storage/question_file/'. $question->id .'.gif'))
						    <img src="/storage/question_file/{{ $question->id }}.gif">
						@elseif(file_exists(public_path().'/storage/question_file/'. $question->id .'.mp3'))
							<audio controls src="/storage/question_file/{{ $question->id }}.mp3">
					            <a href="/storage/question_file/{{ $question->id }}.mp3">
					            	Download audio
            					</a>
            				</audio>
						@endif						

						<div class="d-flex justify-content-between">
							<div>
								<button type="button" class="">★気になる！</button>
								<div>
									<a href="/all_answers">回答を見る</a>
								</div>
							</div>
							<div class="border border-dark border-2 rounded-3 row align-items-center">
		  						<a class="" href="/home/{{ $question->id }}">回答する</a>
		  					</div>
						</div>
					</div>
				</div>
			@endforeach
		</main>
	</body>
	<script>
		function deleteQuestion(id) {
			'use strict'
			
			if (confirm('質問を削除しますか？')) {
				document.getElementById(`form_${id}`).submit();
			}
		}
	</script>
</html>