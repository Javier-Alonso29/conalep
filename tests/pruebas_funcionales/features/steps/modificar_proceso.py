from behave import given, when, then
import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys


@given(u'entro a la sección de procesos')
def step_impl(context):
    context.driver.find_element_by_class_name('fas fa-cog').click()
    time.sleep(5.0)

@given(u'selecciono el boton de modificar el proceso Proceso 1')
def step_impl(context):
    context.driver.find_element_by_xpath('/html/body/div[1]/div[1]/section/div/div[1]/div/div[2]/table/tbody/tr/td[5]/a[2]').click()
    time.sleep(1.5)

@given(u'modifico el codigo del proceso como "{codigo}"')
def step_impl(context,codigo):
    context.driver.find_element_by_id('edit_codigo').send_keys(codigo)
    time.sleep(0.5)

@when(u'presiono el botón Guardar cambios')
def step_impl(context):
    context.driver.find_element_by_xpath('//*[@id="editar"]/div/div/div[2]/form/div[4]/div/button').click()
    time.sleep(5.0)

@then(u'puedo ver el codigo del proceso siendo"{nuevo_codigo}".')
def step_impl(context,nuevo_codigo):
    respuesta = context.driver.find_element_by_partial_link_text(nuevo_codigo).text
    assert nuevo_codigo in respuesta