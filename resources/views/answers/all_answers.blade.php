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
						<!--<form class="d-flex" action="/{{ $question->id }}/all_answers" method="GET">-->
						<!--	@csrf-->
						<!--	<select class="form-select w-auto" aria-label="Default select example" name="range">-->
						<!--		<option selected>▼検索範囲</option>-->
						<!--		<option value="all">全て</option>-->
						<!--		<option value="body">本文</option>-->
						<!--		<option value="user_name">ユーザー名</option>-->
						<!--	</select>-->
						<!--	<input class="form-control" type="text" placeholder="検索ワードを入力" aria-label="Search" name="keyword" value="{{ $keyword }}">-->
						<!--	<input class="btn btn-outline-success mx-2" type="submit" value="検索">-->
						<!--	<button>-->
						<!--		<a href="/{{ $question->id }}/all_answers" class="btn btn-outline-success">Clear</a>-->
						<!--	</button>-->
						<!--</form>-->
					</div>
				</div>
			</nav>
		</header>
		<main>
			<a class="d-flex flex-row-reverse my-3 mr-5" href="/">ホームに戻る</a>
			<!--<form id="dropdown" class="d-flex flex-row-reverse">-->
			<!--	<botton type="button" class="bg-blue-500 text-white rounded px-2 my-3 mx-2 w-auto d-flex align-items-center" onclick="sort()">並べ替え</botton>-->
			<!--	<select class="form-select w-auto my-3" aria-label="Default select example" name="sort">-->
			<!--		<option selected>▼並べ替え</option>-->
			<!--		<option value="new">新着順</option>-->
			<!--		<option value="old">古い順</option>-->
			<!--		<option value="favorite">気になる!が多い順</option>-->
			<!--	</select>-->
			<!--</form>-->
			@foreach ($answers as $answer)
				<div class="answers container text-center border border-dark border-2 rounded-3 mb-3">
					<div class='answer'>
						<div class="d-flex justify-content-between">
							<h3 class="row align-items-start">{{ $answer->user_name }} さんの回答</h2>
							@foreach($answer->users as $user)
								@if (Auth::user()->id == $user->id)
									<div class="d-flex justify-content-between align-items-center">
											<a href="/answers/{{ $answer->id }}/edit_answer">回答の編集</a>
									</div>
					  			@endif
				  			@endforeach
						</div>
						<div class="d-flex justify-content-between">
							<p class="row align-items-start">{{ $answer->created_at }}</p>
							@foreach($answer->users as $user)
								@if (Auth::user()->id == $user->id)
									<div class="d-flex justify-content-between">
										<form action="/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" method="post">
											@csrf
											@method('DELETE')
											<a href="#" onclick="deleteAnswer({{ $answer->id }})" style="color:red">回答の削除</a>
										</form>
									</div>
					  			@endif
				  			@endforeach
						</div>
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
								<!--<button type="button" class="">★いいね！</button>-->
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
		function sort() {
			'use strict'
			
			document.getElementById("dropdown").submit();
		}
	</script>
</html>
</x-guest-layout>