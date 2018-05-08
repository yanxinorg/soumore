@extends('layouts.ask')
@section('content')
<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="aw-user-setting">
                    <div class="tabbable">
                        <ul class="nav nav-tabs aw-nav-tabs active">
                            <li><a href="">申请认证</a></li>
                            <li><a href="">安全设置</a></li>
                            <li><a href="">账号绑定</a></li>
                            <li><a href="">隐私/提醒</a></li>
                            <li class="active"><a href="">基本资料</a></li>
                        </ul>
                    </div>

                    <div class="tab-content clearfix">
                        <!-- 基本信息 -->
                        <div class="aw-mod">
                            <div class="mod-body">
                                <div class="aw-mod mod-base">
                                    <div class="mod-head">
                                        <h3>基本信息</h3>
                                    </div>
                                    <form id="setting_form" method="post" action="http://ask.com/?/account/ajax/profile_setting/">
                                        <div class="mod-body">
                                            <dl>
                                                <dt>账号:</dt>
                                                <dd>001@chenframe.com</dd>
                                            </dl>
                                            <dl>
                                                <dt>真实姓名:</dt>
                                                <dd>admin</dd>
                                            </dl>
                                            <dl>
                                                <dt>性别:</dt>
                                                <dd>
                                                    <label>
                                                        <input name="sex" id="sex" value="1" type="radio" checked="checked"> 男						</label>
                                                    <label>
                                                        <input name="sex" id="sex" value="2" type="radio"> 女						</label>
                                                    <label>
                                                        <input name="sex" id="sex" value="3" type="radio"> 保密						</label>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt>生日:</dt>
                                                <dd>
                                                    <select name="birthday_y">
                                                        <option value=""></option>
                                                        <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970" selected="">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option>						</select>
                                                    年						<select name="birthday_m">
                                                        <option value=""></option>
                                                        <option value="1" selected="">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>						</select>
                                                    月						<select name="birthday_d">
                                                        <option value=""></option>
                                                        <option value="1" selected="">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option><option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>						</select>
                                                    日					</dd>
                                            </dl>
                                            <dl>
                                                <dt><label>现居:</label></dt>
                                                <dd>
                                                    <select name="province" class="select_area" style="display: inline-block;"><option value="">请选择省份或直辖市</option><option value="安徽省">安徽省</option><option value="北京市">北京市</option><option value="福建省">福建省</option><option value="甘肃省">甘肃省</option><option value="广东省">广东省</option><option value="广西壮族自治区">广西壮族自治区</option><option value="贵州省">贵州省</option><option value="海南省">海南省</option><option value="河北省">河北省</option><option value="河南省">河南省</option><option value="黑龙江省">黑龙江省</option><option value="湖北省">湖北省</option><option value="湖南省">湖南省</option><option value="吉林省">吉林省</option><option value="江苏省">江苏省</option><option value="江西省">江西省</option><option value="辽宁省">辽宁省</option><option value="内蒙古自治区">内蒙古自治区</option><option value="宁夏回族自治区">宁夏回族自治区</option><option value="青海省">青海省</option><option value="山东省">山东省</option><option value="山西省">山西省</option><option value="陕西省">陕西省</option><option value="上海市">上海市</option><option value="四川省">四川省</option><option value="天津市">天津市</option><option value="西藏自治区">西藏自治区</option><option value="新疆维吾尔自治区">新疆维吾尔自治区</option><option value="云南省">云南省</option><option value="浙江省">浙江省</option><option value="重庆市">重庆市</option><option value="香港">香港</option><option value="澳门">澳门</option><option value="台湾">台湾</option></select> <select name="city" class="select_area"></select>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt><label>职业:</label></dt>
                                                <dd>
                                                    <select name="job_id">
                                                        <option value="0">--</option>
                                                        <option value="1">销售</option><option value="2">市场/市场拓展/公关</option><option value="3" selected="">商务/采购/贸易</option><option value="4">计算机软、硬件/互联网/IT</option><option value="5">电子/半导体/仪表仪器</option><option value="6">通信技术</option><option value="7">客户服务/技术支持</option><option value="8">行政/后勤</option><option value="9">人力资源</option><option value="10">高级管理</option><option value="11">生产/加工/制造</option><option value="12">质控/安检</option><option value="13">工程机械</option><option value="14">技工</option><option value="15">财会/审计/统计</option><option value="16">金融/银行/保险/证券/投资</option><option value="17">建筑/房地产/装修/物业</option><option value="18">交通/仓储/物流</option><option value="19">普通劳动力/家政服务</option><option value="20">零售业</option><option value="21">教育/培训</option><option value="22">咨询/顾问</option><option value="23">学术/科研</option><option value="24">法律</option><option value="25">美术/设计/创意</option><option value="26">编辑/文案/传媒/影视/新闻</option><option value="27">酒店/餐饮/旅游/娱乐</option><option value="28">化工</option><option value="29">能源/矿产/地质勘查</option><option value="30">医疗/护理/保健/美容</option><option value="31">生物/制药/医疗器械</option><option value="32">翻译（口译与笔译）</option><option value="33">公务员</option><option value="34">环境科学/环保</option><option value="35">农/林/牧/渔业</option><option value="36">兼职/临时/培训生/储备干部</option><option value="37">在校学生</option><option value="38">其他</option>						</select>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt><label>介绍:</label></dt>
                                                <dd class="introduce"><input class="form-control" name="signature" maxlength="128" type="text" value="hgjhgj "></dd>
                                            </dl>
                                            <dl class="form-horizontal">
                                                <dt><label>个性网址:</label></dt>
                                                <dd>
                                                    <script type="text/javascript">document.write(G_BASE_URL);</script>http://ask.com/?/people/ <input type="text" class="form-control" value="admin" maxlength="32" name="url_token" style="display:inline;width:30%;margin-bottom:0;">
                                                    <p class="text-color-999">可输入 4~20 位的英文或数字, 30 天内只能修改一次</p>
                                                </dd>
                                            </dl>
                                            <dl>
                                                <dt><label>时区:</label></dt>
                                                <dd>
                                                    <select class="time" name="default_timezone">
                                                        <option value="">使用系统默认时区</option>
                                                        <option value="Etc/GMT+12">(GMT - 12:00 小时) 安尼威托克岛，卡瓦加兰</option>
                                                        <option value="Etc/GMT+11">(GMT - 11:00 小时) 中途岛，萨摩亚</option>
                                                        <option value="Etc/GMT+10">(GMT - 10:00 小时) 夏威夷</option>
                                                        <option value="Etc/GMT+9">(GMT - 9:00 小时) 阿拉斯加</option>
                                                        <option value="Etc/GMT+8">(GMT - 8:00 小时) 太平洋时间</option>
                                                        <option value="Etc/GMT+7">(GMT - 7:00 小时) 美国山区时间</option>
                                                        <option value="Etc/GMT+6">(GMT - 6:00 小时) 美国中部时间，墨西哥市</option>
                                                        <option value="Etc/GMT+5">(GMT - 5:00 小时) 美国东部时间，波哥大，利马</option>
                                                        <option value="Etc/GMT+4">(GMT - 4:00 小时) 大西洋时间（加拿大），加拉加斯，拉巴斯</option>
                                                        <option value="Canada/Newfoundland">(GMT - 3:30 小时) 纽芬兰</option>
                                                        <option value="Etc/GMT+3">(GMT - 3:00 小时) 巴西，布宜诺斯艾利斯，福克兰群岛</option>
                                                        <option value="Etc/GMT+2">(GMT - 2:00 小时) 大西洋中部，亚森欣，圣赫勒拿岛</option>
                                                        <option value="Etc/GMT+1">(GMT - 1:00 小时) 亚速群岛，佛得角群岛</option>
                                                        <option value="Etc/GMT">(GMT) 卡萨布兰卡，都柏林，伦敦，里斯本，蒙罗维亚</option>
                                                        <option value="Etc/GMT-1">(GMT + 1:00 小时) 布鲁塞尔，哥本哈根，马德里，巴黎</option>
                                                        <option value="Etc/GMT-2">(GMT + 2:00 小时) 加里宁格勒，南非</option>
                                                        <option value="Etc/GMT-3">(GMT + 3:00 小时) 巴格达，利雅德，莫斯科，奈洛比</option>
                                                        <option value="Iran">(GMT + 3:30 小时) 德黑兰</option>
                                                        <option value="Etc/GMT-4">(GMT + 4:00 小时) 阿布达比，巴库，马斯喀特，第比利斯</option>
                                                        <option value="Asia/Kabul">(GMT + 4:30 小时) 喀布尔</option>
                                                        <option value="Etc/GMT-5">(GMT + 5:00 小时) 凯萨琳堡，克拉嗤，塔什干</option>
                                                        <option value="Asia/Kolkata">(GMT + 5:30 小时) 孟买，加尔各答，马德拉斯，新德里</option>
                                                        <option value="Etc/GMT-6">(GMT + 6:00 小时) 阿拉木图，科隆巴，达卡</option>
                                                        <option value="Etc/GMT-7">(GMT + 7:00 小时) 曼谷，河内，雅加达</option>
                                                        <option value="Etc/GMT-8">(GMT + 8:00 小时) 北京，香港，澳洲伯斯，新加坡，台北</option>
                                                        <option value="Etc/GMT-9">(GMT + 9:00 小时) 大阪，札幌，首尔，东京，亚库次克</option>
                                                        <option value="Etc/GMT-10">(GMT + 10:00 小时) 墨尔本，巴布亚新几内亚，雪梨</option>
                                                        <option value="Etc/GMT-11">(GMT + 11:00 小时) 马加丹，新喀里多尼亚，所罗门群岛</option>
                                                        <option value="Etc/GMT-12">(GMT + 12:00 小时) 新西兰，斐济，马绍尔群岛</option>
                                                        <option value="Etc/GMT-13">(GMT + 13:00 小时) 堪察加半岛，阿那底河</option>
                                                        <option value="Etc/GMT-14">(GMT + 14:00 小时) 圣诞岛</option>
                                                    </select>
                                                </dd>
                                            </dl>
                                            <!-- 上传头像 -->
                                            <div class="side-bar">
                                                <dl>
                                                    <dt class="pull-left"><img class="aw-border-radius-5" src="./基本资料 - 设置 - WeCenter_files/01_avatar_max.jpg" alt="" id="avatar_src"></dt>
                                                    <dd class="pull-left">
                                                        <h5>头像设置</h5>
                                                        <p>支持 jpg、gif、png 等格式的图片</p>
                                                        <a class="btn btn-mini btn-success" id="avatar_uploader" href="javascript:;"><form method="post" enctype="multipart/form-data" id="upload-form" action="http://ask.com/?/account/ajax/avatar_upload/" target="ajaxUpload"><input type="submit" class="submit"><input type="file" class="file-input" name="aws_upload_file" multiple="multiple"></form>上传头像</a> <span id="avatar_uploading_status" class="collapse"><i class="aw-loading"></i> 文件上传中...</span>
                                                    </dd>
                                                </dl>
                                            </div>
                                            <!-- end 上传头像 -->
                                        </div>
                                    </form></div>
                                <!-- end 基本信息 -->

                                <!-- 联系方式 -->
                                <div class="aw-mod mod-contact">
                                    <div class="mod-head">
                                        <h3>联系方式</h3>
                                    </div>
                                    <div class="mod-body clearfix">
                                        <ul>
                                            <li>
                                                <label for="input-qq">QQ:</label>
                                                <input class="form-control" type="text" id="input-qq" name="qq" value="0">
                                            </li>
                                            <li>
                                                <label for="input-mobile">手机号码:</label>
                                                <input class="form-control" type="text" id="input-mobile" name="mobile" value="">
                                            </li>
                                            <li>
                                                <label for="input-common-email">常用邮箱:</label>
                                                <input class="form-control" type="text" id="input-common-email" name="common_email" value="">
                                            </li>
                                            <li>
                                                <label for="input-homepage">网站:</label>
                                                <input class="form-control" type="text" id="input-homepage" name="homepage" value="">
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- end 联系方式 -->


                                <!-- 教育经历 -->
                                <div class="aw-mod aw-user-educate">
                                    <div class="mod-head">
                                        <h3>教育经历</h3>
                                    </div>
                                    <div class="mod-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th>学校名称</th>
                                                <th>所在院系</th>
                                                <th width="20%">入学年份</th>
                                                <th width="20%">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="school form-control" placeholder="如:xx大学...">
                                                </td>
                                                <td>
                                                    <input type="text" class="departments form-control" placeholder="如:工程学院计算机系...">
                                                </td>
                                                <td>
                                                    <select class="year">
                                                        <option value=""></option>
                                                        <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option>								</select>
                                                    年							</td>
                                                <td><a class="add-educate">添加</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end 教育经历 -->

                                <!-- 工作经历 -->
                                <div class="aw-mod aw-user-work">
                                    <div class="mod-head">
                                        <h3>工作经历</h3>
                                    </div>
                                    <div class="mod-body">
                                        <table class="table">
                                            <thead>
                                            <tr>
                                                <th width="30%">公司名称</th>
                                                <th>所在职位</th>
                                                <th>工作时间</th>
                                                <th width="15%">操作</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" class="company form-control" placeholder="xx上市公司...">
                                                </td>
                                                <td>
                                                    <select class="work">
                                                        <option value=""></option>
                                                        <option value="1">销售</option><option value="2">市场/市场拓展/公关</option><option value="3">商务/采购/贸易</option><option value="4">计算机软、硬件/互联网/IT</option><option value="5">电子/半导体/仪表仪器</option><option value="6">通信技术</option><option value="7">客户服务/技术支持</option><option value="8">行政/后勤</option><option value="9">人力资源</option><option value="10">高级管理</option><option value="11">生产/加工/制造</option><option value="12">质控/安检</option><option value="13">工程机械</option><option value="14">技工</option><option value="15">财会/审计/统计</option><option value="16">金融/银行/保险/证券/投资</option><option value="17">建筑/房地产/装修/物业</option><option value="18">交通/仓储/物流</option><option value="19">普通劳动力/家政服务</option><option value="20">零售业</option><option value="21">教育/培训</option><option value="22">咨询/顾问</option><option value="23">学术/科研</option><option value="24">法律</option><option value="25">美术/设计/创意</option><option value="26">编辑/文案/传媒/影视/新闻</option><option value="27">酒店/餐饮/旅游/娱乐</option><option value="28">化工</option><option value="29">能源/矿产/地质勘查</option><option value="30">医疗/护理/保健/美容</option><option value="31">生物/制药/医疗器械</option><option value="32">翻译（口译与笔译）</option><option value="33">公务员</option><option value="34">环境科学/环保</option><option value="35">农/林/牧/渔业</option><option value="36">兼职/临时/培训生/储备干部</option><option value="37">在校学生</option><option value="38">其他</option>								</select>
                                                </td>
                                                <td>
                                                    <select class="syear">
                                                        <option value=""></option>
                                                        <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option>								</select>
                                                    &nbsp;&nbsp;年 &nbsp;&nbsp; 至&nbsp;&nbsp;
                                                    <select class="eyear">
                                                        <option value=""></option>
                                                        <option value="2018">2018</option><option value="2017">2017</option><option value="2016">2016</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option><option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option><option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option><option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option><option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option><option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option><option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option><option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option><option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option><option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option><option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option><option value="1905">1905</option><option value="1904">1904</option><option value="1903">1903</option><option value="1902">1902</option><option value="1901">1901</option>								</select>
                                                    年							</td>
                                                <td><a class="add-work">添加</a></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- end 工作经历 -->
                            </div>
                            <div class="mod-footer clearfix">
                                <a href="javascript:;" class="btn btn-large btn-success pull-right" onclick="AWS.ajax_post($(&#39;#setting_form&#39;));">保存</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection