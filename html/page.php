<!DOCTYPE html>
<!--[if IE 8]>
<html lang="uk" class="ie8"><![endif]-->
<!--[if !IE]><!--> <html lang="uk"> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <title>Caffelino</title>
  <meta name="description" content="This personal page company Caffelino">
  
  <!-- Stylesheets -->
  <link rel="stylesheet" href="css/style.css" />
  <!--[if lt IE 9]> 
   <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script> 
  <![endif]-->
</head>

<body>
<div class="mwrapper">
  <div class="wrapper">
  
    <div class="login">
      <form method="post">
        <label class="name" for="name">
        <input class="name" type="text" name="name"></label>
        <label class="pwd" for="pwd">
        <input class="pwd" type="password" name="pwd"></label>
      </form>
    </div>
  
    <div class="logo"></div>
    
    <div class="qphone"><span class="desc_phone">Номер для заказа:</span><p><span>+38 (050)</span> 540-57-32</p></div> 
    <div class="mcart"><p>Ваша корзина пуста</p></div>
    
    <div class="header_menu">
      <div class="sep_menu_l"></div>
      <div class="main_menu">
        <ul>
          <li><a href="index.php">Главная</a></li>
          <li><a href="">О нас</a></li>
          <li><a href="">Меню</a></li>
          <li class="active"><a href="order.php">Заказ</a></li>
          <li><a href="">Контакты</a></li>
        </ul>
      </div>
      <div class="sep_menu_r"></div>
    </div>
    
    <div class="content">
      <div class="left_block">
        <div class="menu">
          <h3><div class="sep_menu_l"></div>Каталог продукции<div class="sep_menu_r"></div></h3>
          <ul>
            <li><a href="">Кофе</a></li>
            <li><a href="">Чай</a></li>
            <li><a href="">Капсульные эспрессо кофеварки</a></li>
            <li><a href="">Ручные эспрессо кофеварки</a></li>
            <li><a href="">Автоматические эспрессо кофеварки</a></li>
            <li><a href="">Профессиональные кофеварки</a></li>
            <li><a href="">Кофемолки</a></li>
            <li><a href="">Кофейные аксессуары</a></li>
          </ul>
        </div>
        
        <div class="filter">
          <h3><div class="sep_menu_l"></div>Подбор параметров<div class="sep_menu_r"></div></h3>
          <form method="post">
            <div class="group_param_1">
              <h4>Клас</h4>
              <ul class="filter_by_class">
                  <li>
                    <label>
                      <input type="checkbox" name="class">
                      <a href=""><span>Капсульные эспрессо кофеварки</span></a>
                      <i>(10)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="class">
                      <a href=""><span>Ручные эспрессо кофеварки</span></a>
                      <i>(23)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="class">
                      <a href=""><span>Автоматические эспрессо кофеварки</span></a>
                      <i>(14)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="class">
                      <a href=""><span>Профессиональные кофеварки</span></a>
                      <i>(7)</i>
                    </label>
                  </li>
              </ul>
            </div>
            <div class="group_param_2">
              <h4>Производитель</h4>
              <ul class="filter_by_name">
                  <li>
                    <label>
                      <input type="checkbox" name="name">
                      <a href=""><span>Blaser</span></a>
                      <i>(3)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="name">
                      <a href=""><span>De`Longhi</span></a>
                      <i>(34)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="name">
                      <a href=""><span>Gaggia</span></a>
                      <i>(9)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="name">
                      <a href=""><span>Philips</span></a>
                      <i>(17)</i>
                    </label>
                  </li>
                  <li>
                    <label>
                      <input type="checkbox" name="name">
                      <a href=""><span>Saeco</span></a>
                      <i>(5)</i>
                    </label>
                  </li>
              </ul>
            </div>
            <div class="group_param_3">
              <h4>Цена</h4>
              <label>
                <span>от</span>
                <input class="filter_price" type="text" name="price">
              </label>
              <label>
                <span>до</span>
                <input class="filter_price" type="text" name="price">
                <span>грн.</span>
              </label>
            </div>
            <input class="reset" type="reset" name="reset" value="Сбросить фильтр">
          </form>
        </div>
      </div>
      
      
      <div class="catalog">
      <h1>Gaggia Brera Black</h1>
        
        <div class="item_product_short">
          <a class="product_img" href=""><img src="images/photo/equip-01m.png"></a>
          <p class="price_new">7 249 грн.</p><a class="add_to_cart" href=""><span class="cart">Купить</span></a>
          <p class="price_real"><span class="price_real">7 899 грн.</span></p>
          <p class="short_desc">Мощность: 850 Вт. Объем резервуара для воды: 1 л. Давление: 15 бар. Приготовление капучино: ручное. Съемный лоток для сбора капель. Габариты (ШхВхГ): 25,5х44,5х34,3 см. Вес: 2,8 кг. Цвет: черный.</p>
          <div class="review">
            <a class="comment" href="">Отзывов (2)</a>
            <span class="rating_4">2 голоса</span>
          </div>
        </div>
        
        <div class="characters_block">
        <h2>Характеристики Gaggia Brera Black</h2>
        <table class="characters">
          <tr>
            <td>Питание</td>
            <td>230 В/50 Гц</td>
          </tr>
          <tr>
            <td>Мощность</td>
            <td>1400 Вт</td>
          </tr>
          <tr>
            <td>Давление помпы</td>
            <td>15 бар</td>
          </tr>
          <tr>
            <td>Объем резервуара для воды</td>
            <td>1,2 л</td>
          </tr>
          <tr>
            <td>Емкость для кофе в зернах</td>
            <td>250 гр</td>
          </tr>
          <tr>
            <td>Материал бойлера</td>
            <td>нерж. сталь</td>
          </tr>
          <tr>
            <td>Материал/отделка</td>
            <td>АБС-пластик/нерж. сталь</td>
          </tr>
          <tr>
            <td>Насадка панарелло</td>
            <td>нерж. сталь</td>
          </tr>
        </table>
        </div>
        
        <div class="review_block">
          <h2>Отзывы к Gaggia Brera Black</h2>
          <form id="review_add" action="" method="post">
          <label>
            <span>Ваше имя:</span>
            <input id="name" type="text" name="name">
          </label>
          <label>
            <span>Оценка товара:</span>
            <ul class="ul">
              <li class="active"></li>
              <li class="active"></li>
              <li class="active"></li>
              <li class=""></li>
              <li class=""></li>
            </ul>
            <input type="hidden" value="3" name="rating">
          </label>
          <label><span style="padding:10px 0 0 0;">Комментарий:</span>
          <textarea id="comment" name="comment"></textarea></label>
          <input id="send" type="submit" name="send" value="Добавить отзыв">
          </form>
          
          <div class="review_vote">
            <div class="user">
              <span>Иванов Иван Иванович</span>
              <p>Моя оценка <span class="rating_4"></span></p>
            </div>
            <div class="say_review"></div>
            <div class="comment">
              <p>Пользуюсь 6 лет. Нареканий нет, только нужно иметь кофемолку с жерновами, молоть перед приготовлением, подобрать помол, греть чашки и привыкнуть к капучинатору и выбрать тип молока.</p>
            </div>
          </div>
          
          <div class="review_vote">
            <div class="user">
              <span>Иванов Иван Иванович</span>
              <p>Моя оценка <span class="rating_4"></span></p>
            </div>
            <div class="say_review"></div>
            <div class="comment">
              <p>Пользуюсь 6 лет. Нареканий нет, только нужно иметь кофемолку с жерновами, молоть перед приготовлением, подобрать помол, греть чашки и привыкнуть к капучинатору и выбрать тип молока.</p>
            </div>
          </div>
          
        </div>
        
      </div>
      
    </div>
  </div>
</div>


<div class="fshadow"></div>
<div class="f_wrapper">
  <div id="footer">
    <div class="menuf">
      <ul>
        <li><a href="">Главная</a></li>
        <li><a href="">О нас</a></li>
        <li><a href="">Меню</a></li>
        <li><a href="">Заказ</a></li>
        <li><a href="">Контакты</a></li>
      </ul>
    </div>
    <div class="copyright"><p>2014 Кофейня Caffelino. Все права защищены.</p></div>
    <div class="socials">
    	<a class="email" href=""></a>
        <a class="google" href=""></a>
        <a class="facebook" href=""></a>
        <a class="twitter" href=""></a>
    </div>
  </div>
</div>

</body>
</html>