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
								<a class="nav-link active" aria-current="page" href="/my_posted_questions">マイ投稿</a>
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
			<div class="d-flex justify-content-between">
				<ul class="nav nav-tabs">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="/my_posted_questions">投稿した質問</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="/my_posted_answers">回答した質問</a>
					</li>
				</ul>
				<select class="form-select w-auto mx-2" aria-label="Default select example">
					<option selected>▼並べ替え</option>
					<option value="1">新着順</option>
					<option value="2">気になる!が多い順</option>
					<option value="3">回答数順</option>
				</select>
			</div>
			<div class="questions container text-center border border-dark border-2 rounded-3">
				<div class='question'>
					<h2 class='title row align-items-start'>投稿した質問タイトル</h2>
					<p class="row align-items-start">2022/11/5(投稿日付)</p>
					<p class="row align-items-start">音楽カテゴリ</p>
					<p class='body row align-items-start'>投稿した質問文</p>
					<div class="d-flex justify-content-between">
						<div>
							<p class="row align-items-start">★気になる！：10(数字カウント)</p>
							<div class="row align-items-start">
								<a class="row align-items-start" href="/all_answers">回答を見る</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>
	</body>

</html>