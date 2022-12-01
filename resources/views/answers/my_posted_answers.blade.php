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
						<a class="nav-link" aria-current="page" href="/my_posted_questions">投稿した質問</a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" href="/my_posted_answers">投稿した回答</a>
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
			@foreach ($user_answers as $answer)
				<div class="answers container text-center border-gray-300 border-1 rounded-3 mb-3 px-4 py-2 bg-white">
					<div class='answer'>
						<div class="d-flex justify-content-between">
							<div>
								<p class="row align-items-start mb-0" style="font-size: 15px; opacity: 0.7;">質問ユーザー：{{ $answer->user_name }}</p>
								<p class="row align-items-start" style="font-size: 15px; opacity: 0.7;">投稿日時：{{ $answer->created_at }}</p>
							</div>
							<div class="d-flex align-items-center">
								@auth
									@foreach($answer->users as $user)
										@if (Auth::user()->id == $user->id)
											<div class="d-flex justify-content-between">
												<a type="button" href="/answers/{{ $answer->id }}/edit_answer" class="mr-1 d-flex justify-content-between btn btn-sm btn-outline-success">
													<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
														<path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
														<path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
													</svg>
												</a>
												<form action="/answers/{{ $answer->id }}" id="form_{{ $answer->id }}" id="form_{{ $answer->id }}" method="post">
													@csrf
													@method('DELETE')
													<a type="botton" href="#" onclick="deleteAnswer({{ $answer->id }})" class="d-flex justify-content-between btn btn-sm btn-outline-danger">
														<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
															<path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
														</svg>
													</a>
												</form>
											</div>
						  				@endif
					  				@endforeach
				  				@endauth
				  			</div>
						</div>
						<p class='body row align-items-start text-left' style="font-size: 18px; white-space: pre-wrap;">{{ $answer->body }}</p>
						<div class="flex justify-center">
							@if(strrpos($answer->file_path, '.png'))
							    <img src="{{ $answer->file_path }}">
							@elseif(strrpos($answer->file_path, '.mp3'))
								<audio controls src="{{ $answer->file_path }}">
						            <a href="{{ $answer->file_path }}">
						            	Download audio
	            					</a>
	            				</audio>
							@endif
						</div>
						<div class="d-flex justify-content-between">
							<div>
								<!--<button type="button" class="">★いいね！</button>-->
							</div>
						</div>
					</div>
				</div>
			@endforeach
		</main>
		<script>
			function deleteAnswer(id) {
				'use strict'
				
				if (confirm('回答を削除しますか？')) {
					document.getElementById(`form_${id}`).submit();
				}
			}
		</script>
	</body>
</html>
</x-guest-layout>