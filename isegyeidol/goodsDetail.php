<?php
include 'includes/pdo-dbconfig.php';
include 'includes/getData.php';

$id = isset($_GET['id']) && $_GET['id'] != '' && is_numeric($_GET['id']) ? $_GET['id'] : '';
$query = "select * from goods where id=$id";
$item = getData($pdo, $id);
?>

<!DOCTYPE html>
<html lang="kr">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Good Detail <?= $item['name'] ?> Page</title>

	<!--Google Material Icons-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />

	<!--GSAP & ScrollToPlugin-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/gsap.min.js" integrity="sha512-IQLehpLoVS4fNzl7IfH8Iowfm5+RiMGtHykgZJl9AWMgqx0AmJ6cRWcB+GaGVtIsnC4voMfm8f2vwtY+6oPjpQ==" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.5.1/ScrollToPlugin.min.js" integrity="sha512-nTHzMQK7lwWt8nL4KF6DhwLHluv6dVq/hNnj2PBN0xMl2KaMm1PM02csx57mmToPAodHmPsipoERRNn4pG7f+Q==" crossorigin="anonymous"></script>

	<link rel="icon" href="source/img/main-logo.png" type="image/x-icon" />
  <link rel="shortcut icon" href="source/img/main-logo.png" type="image/x-icon"/>
	
	<link rel="stylesheet" href="./css/goodsStyle.css">
	<script defer src="./js/topscroll.js"></script>

</head>

<body>
	<?php include 'includes/part/nav.php'; ?>
	<main>
		<section class="content-wrapper">
			<div class="goods-content">
				<img src="<?= $item['img'] ?>" alt="">
				<div class="item-detail">
					<span class="title"><?= strtoupper($item['name']); ?></span><br>
					<span><img src="./source/icons/goods_icon.png" alt="date">Production : <?= strtoupper($item['production']) ?></span><br>
					<span><img src="./source/icons/kind_logo.png" alt="date">Kind : <?= strtoupper($item['kind']) ?></span><br>
					<span><img src="./source/icons/price_icon.png" alt="date">Price : <?= $item['price'] ?> won</span>
				</div>
			</div>

			<div class="item-detail">
				<div class="btn-group">
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#detail-img">상세보기</a></button>
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#delivery">배송정보</a></button>
					<button class="button button--wayra button--border-thick button--text-upper button--size-s"><a href="#change">반품/교환 정보</a></button>
				</div>

				<div class="detail-img" id="detail-img">
					<img src="<?= $item['detailImg'] ?>" alt="null">
				</div>

				<div class="pay" id="pay">

					<div class="pay-info">
						<h2>결제 안내</h2>
						<ul>
							<li>결제수단 : 신용카드, 가상계좌(무통장 입금)</li>
							<li style="list-style: none;">※ 환불 시 결제하신 수단으로만 환불이 가능하며, 별도의 계좌이체는 불가합니다.</li>
							<li style="list-style: none;">※ 아래 안내되는 내용을 확인하지 않아 발생하는 문제는 도움 드릴 수 없습니다.</li>
						</ul>
						<ul>
							<li>주문 완료 표시 된 주문의 결제 수단은 변경이 불가합니다.</li>
							<li>카드 고액 결제의 경우 안전을 위해 카드사에서 확인 전화를 드릴 수도 있습니다.</li>
							<li>무통장 입금 (가상 계좌) 입금 기한은 주문 당일 오후 23시 59분 59초 까지 입금하셔야 합니다. (ex.5월 2일 오후 11시 30분 무통장으로 구매 시 5월 2일 까지 입금)</li>
							<li>해당 기간 이후 입금하시는 가상계좌로 입금은 가능해도 쇼핑몰 시스템에서는 자동 취소됩니다. 주문건 복구는 절대 불가하오니 유의바랍니다.</li>
							<li> 무통장 입금 (가상 계좌)으로 결제하는 경우 은행사 시스템에 따라 23시 20분 이후 입금이 불가 할 수 있습니다. 이용하시는 은행의 시스템 점검 시간 확인 부탁드립니다.</li>
							<li>무통장 입금 (가상 계좌)의 경우 은행 정책상 ATM 기계를 통한 입금이 제한될 수 있습니다. (농협, 수협 등 일부 은행) 이 경우 은행 창구를 이용하시거나 온라인 뱅킹 이용 부탁드립니다.</li>
							<li>확인 과정 중 도난 카드의 사용이나 타인 명의의 주문 등 정상적인 주문이 아니라고 판단될 경우 임의로 주문을 취소 또는 보류할 수 있습니다.</li>
						</ul>
					</div>

				</div>

				<div class="delivery" id="delivery">

					<div class="deliv-info">
						<h2>배송안내</h2>
						<ul>
							<li>배송 방법 : 택배 (CJ대한통​운 or 우체국택배)</li>
							<li>배송 지역 : 전국지역</li>
							<li>배송 비용 : 3,000원</li>
							<li>배송 기간 : 주문일 기준 영업일 2일 ~ 7일</li>
						</ul>
						<ul>
							<li>산간벽지나 도서지방은 기본 금액 외 별도의 추가 금액을 지불하셔야 합니다. 고객님께서 주문하신 상품은 결제 완료 후 배송이 시작됩니다. 상품 준비 기간 및 재고 상황에 따라 배송 기간이 다소 지연될 수도 있습니다.</li>
							<li>예약 판매 상품은 상세페이지 내 표시 된 출시일 이후부터 순차적으로 배송이 진행되며, 주문 순서에 따라 전체 물량 출고까지 주말·공휴일(대체공휴일 포함)을 제외한 평일 기준 7일 이상 소요될 수 있습니다.</li>
							<li>각 상품의 발매일(출시일) 기준으로 합배송 됩니다. 출시일이 다른 경우 합배송이 불가합니다.</li>
						</ul>
					</div>

				</div>

				<div class="change" id="change">
					<div class="change-detail">

						<h2>교환/반품 안내</h2>
						<ul>
							교환 및 반품 시 유의사항
							<li>상품의 색상은 모니터 사양에 따라 실제 색상과는 다소 차이가 있을 수 있으며, 상품 라벨의 위치나 색상은 이미지와 다를 수 있습니다.</li>
							<li>교환 반품 신청 시 반품 택배 발송 전 고객센터 또는 1:1 게시판에 문의글 작성 및 내용 확인 부탁드립니다. 고객 임의로 반품 택배 발송하는 경우 배송비가 청구될 수 있습니다.</li>
						</ul>
						<ul>
							교환∙반품 가능기간
							<li>단순변심 : 상품을 공급 받으신 날로부터 7일 이내 위드뮤 고객센터, 1:1 문의 게시판으로 연락 주시면 신속하게 처리해 드립니다.</li>
							<li>배송 오류, 파손, 불량 등 상품 결함 : 상품 하자, 오배송의 경우 수령일로부터 90일 이내, 그 사실을 알 수 있었던 날로부터 30일이내까지 교환 및 반품이 가능합니다.</li>
						</ul>
						<ul>
							교환 및 반품이 불가능한 경우
							<li>상품 수령 후 7일을 초과한 경우</li>
							<li>상품의 가치가 감소한 경우 (포장지 훼손, 세탁, 상품 얼룩, 향수 냄새, 탈취제 냄새, 증정품 훼손, 구성품 훼손, 사용 흔적 등)</li>
							<li>구매자의 사용 또는 일부 소비에 의하여 상품의 가치가 현저히 감소한 경우</li>
							<li>시간의 경과에 의하여 재판매가 곤란할 정도로 상품등의 가치가 현저히 감소한 경우(상품 바코드 제거, 수선 등)</li>
							<li>주문제작 상품이나 세일 상품, 음반 등 상품 상세페이지에 교환/환불 불가를 공지한 상품의 경우</li>
							<li>복제가 가능한 상품등의 포장을 훼손한 경우</li>
							<li>제품의 오배송, 불량 상품이라도 사용 흔적, 훼손 등의 흔적이 있을 경우</li>
							<li>촬영 또는 해상도 등의 영향으로 고객님의 모니터에서 확인되는 색상과 실제 수령한 상품의 색상 차이가 있을 경우</li>
							<li>상품의 프린트 혹은 패턴이 있는 경우 상품상세페이지 이미지와 다를 수 있습니다.</li>
							<li>교환/반품 진행시 이벤트, 프로모션으로 증정된 증정품을 함께 보내주셔야 하며, 누락시 교환/환불이 불가합니다.</li>
							<li>모든 상품 특성상 재고가 조기 소진될 수 있어 단순변심에 의한 교환은 어려울 수 있으며, 반품/교환은 전자상거래 등에서의 소비자 보호에 관한 법률에 의거한 규정을 따릅니다.</li>
						</ul>
						<ul>
							교환 및 반품 방법
							<li>Step1: 교환∙반품 기간확인</li>
							<li>Step2: 고객센터(1544-4205)또는 1:1문의로 교환∙반품접수</li>
							<li>Step3: CS담당자의 안내 후 지정 반품지 및 지정 반품수단으로 교환∙반품 배송</li>
							<li>Step4: 반품지에 상품 입고 및 검품 후 교환∙반품 진행</li>
							<li>Step5: 교환∙반품 완료</li>
						</ul>
						<ul>
							교환 및 반품 비용
							<li>단순 변심 : 구매자의 변심으로 반품을 원할 경우 구매자가 왕복배송비 지불</li>
							<li>배송 오류, 파손, 불량 등 상품 결함 : 판매자가 배송비 지불</li>
							<li>정확한 교환 및 반품 비용은 1:1 문의 또는 고객센터를 이용해 주시기 바랍니다.</li>
						</ul>

					</div>
				</div>

				<div class="refund" id="refund">
					<div class="refund-info">
						<h2>환불 안내</h2>
						<ul>
							<li>구매 시 결제하신 수단으로만 환불 가능합니다.</li>
							<li>온라인스토어 시스템에서 환불처리 완료 후 PG, 카드사 취소 완료까지 영업일 기준 3~5일 소요됩니다.</li>
						</ul>
						<ul>
							AS 안내
							<li>소비자분쟁해결 기준(공정거래위원회 고시)에 따라 피해를 보상받을 수 있습니다.</li>
							<li>AS관련 문의 1544-4205</li>
						</ul>
						<ul>
							미성년자 권리보호안내
							<li>미성년 고객께서 상품을 주문(계약) 하시는 경우, 법정대리인(부모님 등)이 그 주문(계약)에 동의하지 않으면 미성년자 본인 또는 법정대리인(부모님 등)이 그 주문(계약)을 취소하실 수 있습니다. </li>
						</ul>
					</div>
				</div>

			</div>

		</section>
	</main>

	<!--TO TOP BUTTON-->
	<div id="to-top">
		<div class="material-icons">arrow_upward</div>
	</div>

	<script>
		const toTop = document.querySelector('#to-top');

		toTop.addEventListener('click', function() {
			gsap.to(window, .2, {
				scrollTo: 0
			})
		})
	</script>

</body>

</html>