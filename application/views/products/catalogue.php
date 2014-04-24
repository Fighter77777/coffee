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
      <h1>Автоматические эспрессо кофеварки</h1>
      <p class="quan_prod">Показано 5 товаров из 23<a href="">Показать все</a></p>
        <?php foreach($pr as $p):  ?>
	        <div class="item_product">
	          <a class="product_img" href=""><?php echo $p['img'];  ?></a>
	          <a class="product_name" href=""><?php echo $p['pr_nm'];  ?></a>
	          <p class="price_new"><?php echo $p['price_act'];  ?>грн.</p>
	          <p class="short_desc"><?php echo $p['pr_descr'];  ?></p>
	          <a class="add_to_cart" href=""><span class="cart">Купить</span></a>
	        </div>
        <?php endforeach;  ?>
      </div>
      
    </div>