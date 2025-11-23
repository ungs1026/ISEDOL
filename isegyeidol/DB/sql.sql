SQL

-- user

create table users (
	id int(11) not null auto_increment,
	username varchar(25) not null,
	firstName varchar(50) not null,
	lastName varchar(50) not null,
	email varchar(200) not null,
	password varchar(50) not null,
	signUpDate datetime default now(),
	profilePic varchar(500),
	admin_num int(4),
	primary key(id)
);

-- insert
insert into users(username, firstName, lastName, email, password, profilePic) values 
('tester','te','ster','test@gmail.com','4297f44b13955235245b2497399d7a93','source/img/leaf.png'),
('jingburger','burger','jing','jingburger@gmail.com','4297f44b13955235245b2497399d7a93','source/img/leaf.png');

-- goods
CREATE TABLE goods (
	id int(11) not null AUTO_INCREMENT,
	name varchar(255) DEFAULT '',
	price int(11) DEFAULT 0,
	img varchar(255) DEFAULT '',
	detailImg varchar(255) default '',
	production varchar(255) DEFAULT null,
	sales int(20) default 0,
	kind varchar(50),
	PRIMARY KEY(id)
);

-- insert 
-- kind = cushion / acrylic / photo / sundries / pad / clothes
insert into goods(name, price, img, detailImg, production, sales, kind) values 
('face-cushion', 35000, 'source/img/goods/face-cushion.jpg', 'source/img/goods_detail/detail-face-cushion.jpg', '1stPopUp', 10, 'cushion'),
('acrylic', 29000, 'source/img/goods/acrylic.jpg', 'source/img/goods_detail/detail-acrylic.jpg', '1stPopUp', 15, 'acrylic'),
('photo-card', 7000, 'source/img/goods/photo-card.jpg', 'source/img/goods_detail/detail-photo-card.jpg', '1stPopUp', 150, 'photo'),
('smart-talk', 12000, 'source/img/goods/smart-talk.jpg', 'source/img/goods_detail/detail-smart-talk.jpg', '1stPopUp', 150, 'sundries'),
('sleeping-eye-mask', 15000, 'source/img/goods/sleeping-eye-mask.jpg', 'source/img/goods_detail/detail-sleeping-eye-mask.jpg', '1stPopUp', 250, 'clothes'),
('postcard', 8000, 'source/img/goods/postcard.jpg', 'source/img/goods_detail/detail-postcard.jpg', '1stPopUp', 50, 'photo'),
('sticker', 10000, 'source/img/goods/sticker.jpg', 'source/img/goods_detail/detail-sticker.jpg', '1stPopUp', 350, 'sundries'),
('bookmark', 7000, 'source/img/goods/bookmark.jpg', 'source/img/goods_detail/detail-bookmark.jpg', '1stPopUp', 450, 'sundries'),
('mouse-pad', 8000, 'source/img/goods/mouse-pad.jpg', 'source/img/goods_detail/detail-mouse-pad.jpg', '1stPopUp', 250, 'pad'),
('tumbler', 30000, 'source/img/goods/tumbler.jpg', 'source/img/goods_detail/detail-tumbler.jpg', '1stPopUp', 350, 'sundries'),
('el-holder', 10000, 'source/img/goods/el-holder.jpg', 'source/img/goods_detail/detail-el-holder.jpg', '1stPopUp', 150, 'sundries'),
('sticky-note-pad', 7000, 'source/img/goods/sticky-note-pad.jpg', 'source/img/goods_detail/detail-sticky-note-pad.jpg', '1stPopUp', 150, 'sundries'),
('reusable-bag', 13000, 'source/img/goods/reusable-bag.jpg', 'source/img/goods_detail/detail-reusable-bag.jpg', '1stPopUp', 550, 'clothes'),
('hoodie', 79000, 'source/img/goods/hoodie.jpg', 'source/img/goods_detail/detail-hoodie.jpg', '1stPopUp', 1550, 'clothes'),
('mini-note', 8000, 'source/img/goods/mini-note.jpg', 'source/img/goods_detail/detail-mini-note.jpg', '1stPopUp', 50, 'sundries'),
('photo-bindbook', 15000, 'source/img/goods/photo-bindbook.jpg', 'source/img/goods_detail/detail-photo-bindbook.jpg', '1stPopUp', 250, 'photo'),
('blanket', 43000, 'source/img/goods/blanket.jpg', 'source/img/goods_detail/detail-blanket.jpg', '1stPopUp', 550, 'sundries'),
('pajamas', 39900, 'source/img/goods/pajamas.jpg', 'source/img/goods_detail/detail-pajamas.jpg', '1stPopUp', 1550, 'clothes'),
('hooded-sweatshirt', 49900, 'source/img/goods/hooded-sweatshirt.jpg', 'source/img/goods_detail/detail-hooded-sweatshirt.jpg', '1stPopUp', 2050, 'clothes'),
('sweatshirt', 39900, 'source/img/goods/sweatshirt.jpg', 'source/img/goods_detail/detail-sweatshirt.jpg', '1stPopUp', 2550, 'clothes'),
('short-sleeved-shirt-w', 25900, 'source/img/goods/short-sleeved-shirt-w.jpg', 'source/img/goods_detail/detail-short-sleeved-shirt-w.jpg', '1stPopUp', 5550, 'clothes'),
('short-sleeved-shirt-b', 25900, 'source/img/goods/short-sleeved-shirt-b.jpg', 'source/img/goods_detail/detail-short-sleeved-shirt-b.jpg', '1stPopUp', 5500, 'clothes');

-- albums
create table albums (
	id int(11) not null auto_increment,
	title varchar(250) not null,
	artist int(11) not null,
	artworkPath varchar(250) not null,
	primary key(id)
);

-- insert
insert into albums (title, artist, artworkPath) values
('Playlist_INE', 1, 'source/img/member/ine.png'),
('Playlist_JINGBURGER', 2, 'source/img/member/jingburger.png'),
('Playlist_LILPA', 3, 'source/img/member/lilpa.png'),
('Playlist_JURURU', 4, 'source/img/member/jururu.png'),
('Playlist_GOSEGU', 5, 'source/img/member/gosegu.png'),
('Playlist_VIICHAN', 6, 'source/img/member/viichan.png');


--artists
create table artists(
	id int not null auto_increment,
	name varchar(50) not null,
	primary key(id)
);

--insert
insert into artists (name) values 
('INE'),
('JINGBURGER'),
('LILPA'),
('JURURU'),
('GOSEGU'),
('VIICHAN');

-- songs
create table songs (
	id int(11) not null auto_increment,
	title varchar(250) not null,
	artist int(11) not null,
	album int(11) not null,
	duration varchar(10) not null,
	path varchar(500) not null,
	albumOrder int(11) not null,
	songArt varchar(500) not null,
	plays int(11) not null,
	primary key(id)
);

--insert
-- INE
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('mashup', 1, 1, '3:34', 'source/music_group/1INE/ine_mashup.mp3', 1, 'source/music_group/1INE/ine_mashup.jpg', 0),
('lovely', 1, 1, '3:12', 'source/music_group/1INE/ine_lovely.mp3', 1, 'source/music_group/1INE/ine_lovely.jpg', 0),
('im still standing', 1, 1, '3:01', 'source/music_group/1INE/ine_im_still_standing.mp3', 1, 'source/music_group/1INE/ine_im_still_standing.jpg', 0),
('lost my music', 1, 1, '4:14', 'source/music_group/1INE/ine_lost_my_music.mp3', 1, 'source/music_group/1INE/ine_lost_my_music.jpg', 0),
('sora', 1, 1, '2:27', 'source/music_group/1INE/ine_sora.mp3', 1, 'source/music_group/1INE/ine_sora.jpg', 0),
('star walkin', 1, 1, '3:31', 'source/music_group/1INE/ine_star_walkin.mp3', 1, 'source/music_group/1INE/ine_star_walkin.jpg', 0),
('내 손을 잡아', 1, 1, '3:39', 'source/music_group/1INE/ine_내손을잡아.mp3', 1, 'source/music_group/1INE/ine_내손을잡아.jpg', 0),
('성간비행', 1, 1, '3:01', 'source/music_group/1INE/ine_성간비행.mp3', 1, 'source/music_group/1INE/ine_성간비행.jpg', 0),
('아이네 클라이네', 1, 1, '4:55', 'source/music_group/1INE/ine_아이네클라이네.mp3', 1, 'source/music_group/1INE/ine_아이네클라이네.jpg', 0),
('마리골드', 1, 1, '5:28', 'source/music_group/1INE/ine_마리골드.mp3', 1, 'source/music_group/1INE/ine_마리골드.jpg', 0),
('와스레모노', 1, 1, '3:24', 'source/music_group/1INE/ine_와스레모노.mp3', 1, 'source/music_group/1INE/ine_와스레모노.jpg', 0),
('잔혹한 천사의 태제', 1, 1, '4:07', 'source/music_group/1INE/ine_잔혹한천사의태제.mp3', 1, 'source/music_group/1INE/ine_잔혹한천사의태제.jpg', 0),
('tomboy', 1, 1, '4:03', 'source/music_group/1INE/ine_tomboy.mp3', 1, 'source/music_group/1INE/ine_tomboy.jpg', 0);


-- JINGBURGER
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('and july', 2, 2, '3:49', 'source/music_group/2JINGBURGER/jingburger_and_july.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_and_july.jpg', 0),
('ballin', 2, 2, '3:55', 'source/music_group/2JINGBURGER/jingburger_ballin.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_ballin.jpg', 0),
('brave new world', 2, 2, '4:13', 'source/music_group/2JINGBURGER/jingburger_brave_new_world.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_brave_new_world.jpg', 0),
('cant slow me down', 2, 2, '2:24', 'source/music_group/2JINGBURGER/jingburger_cant_slow_me_down.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_cant_slow_me_down.jpg', 0),
('love war', 2, 2, '3:07', 'source/music_group/2JINGBURGER/jingburger_love_war.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_love_war.jpg', 0),
('stay', 2, 2, '3:08', 'source/music_group/2JINGBURGER/jingburger_stay.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_stay.jpg', 0),
('sway to my beat in cosmos', 2, 2, '2:46', 'source/music_group/2JINGBURGER/jingburger_sway_to_my_beat_in_cosmos.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_sway_to_my_beat_in_cosmos.jpg', 0),
('tomboy', 2, 2, '3:29', 'source/music_group/2JINGBURGER/jingburger_tomboy.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_tomboy.jpg', 0),
('강풍올백', 2, 2, '2:16', 'source/music_group/2JINGBURGER/jingburger_강풍올백.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_강풍올백.jpg', 0),
('봄도둑', 2, 2, '5:41', 'source/music_group/2JINGBURGER/jingburger_봄도둑.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_봄도둑.jpg', 0),
('저곳으로', 2, 2, '3:32', 'source/music_group/2JINGBURGER/jingburger_저곳으로.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_저곳으로.jpg', 0),
('좋아하니까', 2, 2, '5:02', 'source/music_group/2JINGBURGER/jingburger_좋아하니까.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_좋아하니까.jpg', 0),
('혼돈부기', 2, 2, '2:35', 'source/music_group/2JINGBURGER/jingburger_혼돈부기.mp3', 2, 'source/music_group/2JINGBURGER/jingburger_혼돈부기.jpg', 0);

-- LILPA
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('마지막 재회', 3, 3, '4:22', 'source/music_group/3LILPA/lilpa_마지막재회.mp3', 3, 'source/music_group/3LILPA/lilpa_마지막재회.jpg', 0),
('gaea zero', 3, 3, '3;31', 'source/music_group/3LILPA/lilpa_gaea_zero.mp3', 3, 'source/music_group/3LILPA/lilpa_gaea_zero.jpg', 0),
('always with you', 3, 3, '3:56', 'source/music_group/3LILPA/lilpa_always_with_you.mp3', 3, 'source/music_group/3LILPA/lilpa_always_with_you.jpg', 0),
('chicago roxie', 3, 3, '2:09', 'source/music_group/3LILPA/lilpa_chicago_roxie.mp3', 3, 'source/music_group/3LILPA/lilpa_chicago_roxie.jpg', 0),
('lady', 3, 3, '3:39', 'source/music_group/3LILPA/lilpa_lady.mp3', 3, 'source/music_group/3LILPA/lilpa_lady.jpg', 0),
('불꽃', 3, 3, '4:34', 'source/music_group/3LILPA/lilpa_불꽃.mp3', 3, 'source/music_group/3LILPA/lilpa_불꽃.jpg', 0),
('only one', 3, 3, '3:42', 'source/music_group/3LILPA/lilpa_only_one.mp3', 3, 'source/music_group/3LILPA/lilpa_only_one.jpg', 0),
('this is me', 3, 3, '4:07', 'source/music_group/3LILPA/lilpa_this_is_me.mp3', 3, 'source/music_group/3LILPA/lilpa_this_is_me.jpg', 0),
('u', 3, 3, '3:07', 'source/music_group/3LILPA/lilpa_u.mp3', 3, 'source/music_group/3LILPA/lilpa_u.jpg', 0),
('너로 피어오라', 3, 3, '3:58', 'source/music_group/3LILPA/lilpa_너로피어오라.mp3', 3, 'source/music_group/3LILPA/lilpa_너로피어오라.jpg', 0),
('댄스홀', 3, 3, '3:38', 'source/music_group/3LILPA/lilpa_댄스홀.mp3', 3, 'source/music_group/3LILPA/lilpa_댄스홀.jpg', 0),
('세계는 사랑에 빠져있어', 3, 3, '5:30', 'source/music_group/3LILPA/lilpa_세계는사랑에빠져있어.mp3', 3, 'source/music_group/3LILPA/lilpa_세계는사랑에빠져있어.jpg', 0),
('promise', 3, 3, '4:07', 'source/music_group/3LILPA/lilpa_promise.mp3', 3, 'source/music_group/3LILPA/lilpa_promise.jpg', 0),
('satellites', 3, 3, '3:54', 'source/music_group/3LILPA/lilpa_satellites.mp3', 3, 'source/music_group/3LILPA/lilpa_satellites.jpg', 0),
('타상연화', 3, 3, '3:45', 'source/music_group/3LILPA/lilpa_타상연화.mp3', 3, 'source/music_group/3LILPA/lilpa_타상연화.jpg', 0);

-- JURURU
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('초절정귀여워', 4, 4, '3:00', 'source/music_group/4JURURU/jururu_초절정귀여워.mp3', 4, 'source/music_group/4JURURU/jururu_초절정귀여워.jpg', 0),
('perfect night', 4, 4, '2:48', 'source/music_group/4JURURU/jururu_perfect_night.mp3', 4, 'source/music_group/4JURURU/jururu_perfect_night.jpg', 0),
('튜닝러브', 4, 4, '3:47', 'source/music_group/4JURURU/jururu_튜닝러브.mp3', 4, 'source/music_group/4JURURU/jururu_튜닝러브.jpg', 0),
('달링', 4, 4, '3:17', 'source/music_group/4JURURU/jururu_달링.mp3', 4, 'source/music_group/4JURURU/jururu_달링.jpg', 0),
('어푸', 4, 4, '3:24', 'source/music_group/4JURURU/jururu_어푸.mp3', 4, 'source/music_group/4JURURU/jururu_어푸.jpg', 0),
('masterpiece', 4, 4, '4:48', 'source/music_group/4JURURU/jururu_masterpiece.mp3', 4, 'source/music_group/4JURURU/jururu_masterpiece.jpg', 0),
('scientist', 4, 4, '3:25', 'source/music_group/4JURURU/jururu_scientist.mp3', 4, 'source/music_group/4JURURU/jururu_scientist.jpg', 0),
('귀여워서 미안해', 4, 4, '3:41', 'source/music_group/4JURURU/jururu_귀여워서미안해.mp3', 4, 'source/music_group/4JURURU/jururu_귀여워서미안해.jpg', 0),
('너에게 닿기를', 4, 4, '3:27', 'source/music_group/4JURURU/jururu_너에게닿기를.mp3', 4, 'source/music_group/4JURURU/jururu_너에게닿기를.jpg', 0),
('달이 아름다워', 4, 4, '3:27', 'source/music_group/4JURURU/jururu_달이아름다워.mp3', 4, 'source/music_group/4JURURU/jururu_달이아름다워.jpg', 0),
('봄 사랑 벚꽃 말고', 4, 4, '3:43', 'source/music_group/4JURURU/jururu_봄사랑벚꽃말고.mp3', 4, 'source/music_group/4JURURU/jururu_봄사랑벚꽃말고.jpg', 0),
('아이돌', 4, 4, '3:33', 'source/music_group/4JURURU/jururu_아이돌.mp3', 4, 'source/music_group/4JURURU/jururu_아이돌.jpg', 0),
('액션의 잔상 끝 없는 모험', 4, 4, '3:24', 'source/music_group/4JURURU/jururu_액션의잔상_끝없는모험.mp3', 4, 'source/music_group/4JURURU/jururu_액션의잔상_끝없는모험.jpg', 0),
('고민중독', 4, 4, '3:05', 'source/music_group/4JURURU/jururu_고민중독.mp3', 4, 'source/music_group/4JURURU/jururu_고민중독.jpg', 0),
('what is love', 4, 4, '3:36', 'source/music_group/4JURURU/jururu_what_is_love.mp3', 4, 'source/music_group/4JURURU/jururu_what_is_love.jpg', 0),
('고속도로 로망스', 4, 4, '3:55', 'source/music_group/4JURURU/jururu_고속도로_로망스.mp3', 4, 'source/music_group/4JURURU/jururu_고속도로_로망스.jpg', 0);

-- GOSEGU
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('나만봄', 5, 5, '3:44', 'source/music_group/5GOSEGU/gosegu_나만봄.mp3', 5, 'source/music_group/5GOSEGU/gosegu_나만봄.jpg', 0),
('홍련화', 5, 5, '2:57', 'source/music_group/5GOSEGU/gosegu_홍련화.mp3', 5, 'source/music_group/5GOSEGU/gosegu_홍련화.jpg', 0),
('긍지높은 아이돌', 5, 5, '4:26', 'source/music_group/5GOSEGU/gosegu_긍지높은_아이돌.mp3', 5, 'source/music_group/5GOSEGU/gosegu_긍지높은_아이돌.jpg', 0),
('기타와 고독과 푸른 행성', 5, 5, '3:51', 'source/music_group/5GOSEGU/gosegu_기타와_고독과_푸른_행성.mp3', 5, 'source/music_group/5GOSEGU/gosegu_기타와_고독과_푸른_행성.jpg', 0),
('스즈메', 5, 5, '3:58', 'source/music_group/5GOSEGU/gosegu_스즈메.mp3', 5, 'source/music_group/5GOSEGU/gosegu_스즈메.jpg', 0),
('신시대', 5, 5, '3:50', 'source/music_group/5GOSEGU/gosegu_신시대.mp3', 5, 'source/music_group/5GOSEGU/gosegu_신시대.jpg', 0),
('잊어주지 않을거야', 5, 5, '3:40', 'source/music_group/5GOSEGU/gosegu_잊어주지_않을거야.mp3', 5, 'source/music_group/5GOSEGU/gosegu_잊어주지_않을거야.jpg', 0),
('자다깨니 야자수', 5, 5, '1:54', 'source/music_group/5GOSEGU/gosegu_자다깨니_야자수.mp3', 5, 'source/music_group/5GOSEGU/gosegu_자다깨니_야자수.jpg', 0),
('청춘 콤플렉스', 5, 5, '1:32', 'source/music_group/5GOSEGU/gosegu_청춘_콤플렉스.mp3', 5, 'source/music_group/5GOSEGU/gosegu_청춘_콤플렉스.jpg', 0),
('팬 서비스', 5, 5, '4:08', 'source/music_group/5GOSEGU/gosegu_팬서비스.mp3', 5, 'source/music_group/5GOSEGU/gosegu_팬서비스.jpg', 0),
('팬 서비스 1000만', 5, 5, '4:37', 'source/music_group/5GOSEGU/gosegu_팬서비스_1000만.mp3', 5, 'source/music_group/5GOSEGU/gosegu_팬서비스_1000만.jpg', 0),
('별이 되지 않아도 돼', 5, 5, '3:24', 'source/music_group/5GOSEGU/gosegu_별이_되지_않아도_돼.mp3', 5, 'source/music_group/5GOSEGU/gosegu_별이_되지_않아도_돼.jpg', 0);

-- VIICHAN
insert into songs (title, artist, album, duration, path, albumOrder, songArt, plays) values
('tot musica', 6, 6, '3:17', 'source/music_group/6VIICHAN/viichan_tot_musica.mp3', 6, 'source/music_group/6VIICHAN/viichan_tot_musica.jpg', 0),
('daybreak frontline', 6, 6, '4:58', 'source/music_group/6VIICHAN/viichan_daybreak_frontline.mp3', 6, 'source/music_group/6VIICHAN/viichan_daybreak_frontline.jpg', 0),
('ditto', 6, 6, '4:18', 'source/music_group/6VIICHAN/viichan_ditto.mp3', 6, 'source/music_group/6VIICHAN/viichan_ditto.jpg', 0),
('fire again', 6, 6, '3:26', 'source/music_group/6VIICHAN/viichan_fire_again.mp3', 6, 'source/music_group/6VIICHAN/viichan_fire_again.jpg', 0),
('I', 6, 6, '4:12', 'source/music_group/6VIICHAN/viichan_i.mp3', 6, 'source/music_group/6VIICHAN/viichan_i.jpg', 0),
('last night on earth', 6, 6, '3:38', 'source/music_group/6VIICHAN/viichan_last_night_on_earth.mp3', 6, 'source/music_group/6VIICHAN/viichan_last_night_on_earth.jpg', 0),
('some like it hot', 6, 6, '4:09', 'source/music_group/6VIICHAN/viichan_some_like_it_hot.mp3', 6, 'source/music_group/6VIICHAN/viichan_some_like_it_hot.jpg', 0),
('그저 네게 맑아라', 6, 6, '3:38', 'source/music_group/6VIICHAN/viichan_그저_네게_맑아라.mp3', 6, 'source/music_group/6VIICHAN/viichan_그저_네게_맑아라.jpg', 0),
('사랑하긴 했었나요. 스쳐가는 인연이었나요.', 6, 6, '3:22', 'source/music_group/6VIICHAN/viichan_사랑하긴_했었나요_스쳐가는_인연이었나요.mp3', 6, 'source/music_group/6VIICHAN/viichan_사랑하긴_했었나요_스쳐가는_인연이었나요.jpg', 0),
('스물셋', 6, 6, '4:09', 'source/music_group/6VIICHAN/viichan_스물셋.mp3', 6, 'source/music_group/6VIICHAN/viichan_스물셋.jpg', 0),
('유령도쿄', 6, 6, '3:24', 'source/music_group/6VIICHAN/viichan_유령도쿄.mp3', 6, 'source/music_group/6VIICHAN/viichan_유령도쿄.jpg', 0),
('플라스틱 러브', 6, 6, '4:51', 'source/music_group/6VIICHAN/viichan_플라스틱_러브.mp3', 6, 'source/music_group/6VIICHAN/viichan_플라스틱_러브.jpg', 0),
('나는 아픈 건 딱 질색이니까', 6, 6, '2:44', 'source/music_group/6VIICHAN/viichan_나는_아픈_건_딱_질색이니까.mp3', 6, 'source/music_group/6VIICHAN/viichan_나는_아픈_건_딱_질색이니까.jpg', 0);

-- group
create table groups (
	id int(11) not null auto_increment,
	name varchar(50) not null,
	thumbnail varchar(255) not null,
	date date not null,
	year varchar(20) not null,
	kind varchar(50) not null,
	youtube varchar(500) not null,
	primary key(id)
);

-- insert

-- Single
insert into groups (name, thumbnail, date, year, kind, youtube) values
('Re: WIND', 'source/img/single/REWIND.png', '2021-12-17', '2021', 'single', 'https://www.youtube.com/watch?v=fgSXAKsq-Vo'),
('겨울봄', 'source/img/single/겨울봄.png', '2022-03-11', '2022', 'single', 'https://www.youtube.com/watch?v=JY-gJkMuJ94'),
('KIDDING', 'source/img/single/KIDDING.png', '2022-08-18', '2022', 'single', 'https://www.youtube.com/watch?v=rDFUl2mHIW4'),
('LOCKDOWN', 'source/img/single/LOCKDOWN.png', '2023-06-22', '2023', 'single', 'https://www.youtube.com/watch?v=QgMFpuos4Rg'),
('Another World', 'source/img/single/Another World.png', '2023-07-21', '2023', 'single', 'https://www.youtube.com/watch?v=8KTFf2X-ago'),
('Super Hero', 'source/img/single/Super Hero.png', '2023-09-24', '2023', 'single', 'https://www.youtube.com/watch?v=wyhwJnNpVJI'),
('OVER', 'source/img/single/OVER.png', '2023-09-24', '2023', 'single', 'https://www.youtube.com/watch?v=i4SRH9jfUMQ'),
('But You Want More', 'source/img/single/But You Want More.png', '2022-02-15', '2022', 'single', 'https://www.youtube.com/watch?v=VcvMQ9MZhF8'),
('이세돌 싸이퍼', 'source/img/single/이세돌 싸이퍼.png', '2022-04-23', '2022', 'single', 'https://www.youtube.com/watch?v=Empfi8q0aas');

-- COVER
insert into groups (name, thumbnail, date, year, kind, youtube) values
('장난기 기능', 'source/img/cover/장난기기능.png', '2021-09-13', '2021', 'cover', 'https://www.youtube.com/watch?v=fU8picIMbSk'),
('투니버스 메들리', 'source/img/cover/투니버스 메들리.png', '2021-12-05', '2021', 'cover', 'https://www.youtube.com/watch?v=OTkFJyn4mvc'),
('Its Beginning To Look A Lot Like Christmas', 'source/img/cover/Its Beginning To Look A Lot Like Christmas.png', '2021-12-23', '2021', 'cover', 'https://www.youtube.com/watch?v=kNPykP_9wOQ'),
('My WAKTAVERSE', 'source/img/cover/My WAKTAVERSE.png', '2021-12-27', '2021', 'cover', 'https://www.youtube.com/watch?v=Kc85nOaqLwo'),
('우마뾰이 전설', 'source/img/cover/우마뾰이 전설.png', '2022-08-23', '2022', 'cover', 'https://www.youtube.com/watch?v=TYB9ScXvq34'),
('풍선', 'source/img/cover/풍선.png', '2022-08-28', '2022', 'cover', 'https://www.youtube.com/watch?v=21trg6DfzX8'),
('LOVE DIVE', 'source/img/cover/LOVE DIVE.png', '2022-09-05', '2022', 'cover', 'https://www.youtube.com/watch?v=Brf3LWwNVTk'),
('Kissing You', 'source/img/cover/Kissing You.png', '2024-03-20', '2024', 'cover', 'https://www.youtube.com/watch?v=OrFyzG5yTC4');