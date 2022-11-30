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
								<a class="nav-link active" aria-current="page" href="/my_posted_questions">マイ投稿</a>
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
			<div class="d-flex justify-content-between">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="/my_posted_questions">投稿した質問</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/my_posted_answers">投稿した回答</a>
					</li>
				</ul>
				<!--<form id="dropdown" class="d-flex flex-row-reverse">-->
				<!--	<botton type="button" class="bg-blue-500 text-white rounded px-2 my-3 mx-2 w-auto d-flex align-items-center" onclick="sort()">並べ替え</botton>-->
				<!--	<select class="form-select w-auto my-3" aria-label="Default select example" name="sort">-->
				<!--		<option selected>▼並べ替え</option>-->
				<!--		<option value="new">新着順</option>-->
				<!--		<option value="old">古い順</option>-->
				<!--		<option value="favorite">気になる!が多い順</option>-->
				<!--	</select>-->
				<!--</form>-->
			</div>
			@foreach ($user_questions as $question)
				<div class="questions container text-center border border-dark border-2 rounded-3 mb-3">
					<h2 class='title row align-items-start'>{{ $question->title }}</h2>
					<div class="d-flex justify-content-between">
						<p class="row align-items-start">質問ユーザー：{{ $question->user_name }}</p>
						<a href="/questions/{{ $question->id }}/edit_question">質問の編集</a>
					</div>
					<div class="d-flex justify-content-between">
						<p class="row align-items-start">{{ $question->created_at }}</p>
						<form action="/{{ $question->id }}/delete" id="form_{{ $question->id }}" method="post">
							@csrf
							@method('DELETE')
							<a href="#" onclick="deleteQuestion({{ $question->id }})" style="color:red">質問の削除</a>
						</form>
					</div>
					<!--<p class="row align-items-start">音楽カテゴリ：{{ $question->category_id }}</p>-->
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
					<div class="d-flex justify-content-between">
						<div>
							<button type="button" class="bg-yellow-500 text-white rounded px-2 py-1 mb-2">★気になる数</button>
							<div>
								<a href="/{{ $question->id }}/all_answers">回答を見る</a>
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
		function sort() {
			'use strict'
			
			document.getElementById("dropdown").submit();
		}
	</script>
</html>
</x-guest-layout>