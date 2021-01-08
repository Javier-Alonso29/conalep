from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time
from selenium.webdriver.chrome.options import Options

options = Options()
extset = ['enable-automation', 'ignore-certificate-errors']
options.add_argument("--window-size=600,600")
options.add_argument("--headless")
options.add_experimental_option("excludeSwitches", extset)

driver = webdriver.Chrome(options=options)
# driver = webdriver.Chrome()
driver.implicitly_wait(5)

driver.get('http://homestead.test')
driver.find_element_by_id('email').send_keys('test@zac.conalep.edu.mx')
driver.find_element_by_id('password').send_keys('testtesttest' + Keys.ENTER)
time.sleep(0.5)