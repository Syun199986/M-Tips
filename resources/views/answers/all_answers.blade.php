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
			<div class="d-flex flex-row-reverse">
				<select class="form-select w-auto mx-2" aria-label="Default select example">
					<option selected>▼並べ替え</option>
					<option value="1">新着順</option>
					<option value="2">気になる!が多い順</option>
					<option value="3">回答数順</option>
				</select>
			</div>
			@foreach ($answers as $answer)
				<div class="answers container text-center border border-dark border-2 rounded-3 mb-3">
					<div class='answer'>
						<p class="row align-items-start">回答ユーザー：{{ $answer->user_name }}</p>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">{{ $answer->created_at }}</p>
						</div>
						@foreach($answer->users as $user)
							@if (Auth::user()->id == $user->id)
								<div class="d-flex justify-content-between">
										<a href="/answers/{{ $answer->id }}/edit_answer">回答の編集</a>
								</div>
								<div class="d-flex justify-content-between">
									<form action="/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="post">
										@csrf
										@method('DELETE')
										<a href="#" onclick="deleteAnswer({{ $answer->id }})" style="color:red">回答の削除</a>
									</form>
								</div>
				  			@endif
			  			@endforeach
						<p class='body row align-items-start'>{{ $answer->body }}</p>
						@if(strrpos($answer->file_path, '.png'))
						    <img src="{{ $answer->file_path }}">
						@elseif(strrpos($answer->file_path, '.mp3'))
							<audio controls src="{{ $answer->file_path }}">
					            <a href="{{ $answer->file_path }}">
					            	Download audio
            					</a>
            				</audio>
						@endif						
						<div class="d-flex justify-content-between">
							<div>
								<button type="button" class="">★いいね！</button>
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</main>
	</body>
	<script>
		function deleteAnswer(id) {
			'use strict'
			
			if (confirm('回答を削除しますか？')) {
				document.getElementById(`form_${id}`).submit();
			}
		}
	</script>
</html>