from behave import given, when, then
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
import time

@given(u'que ingreso el usuario "{usuario}"')
def step_impl(context, usuario):
    context.driver.get(context.url)
    context.driver.find_element_by_id('email').send_keys(usuario)

@given(u'la contraseña "{password}"')
def step_impl(context, password):
    context.driver.find_element_by_id('password').send_keys(password)

@when(u'presiono el botón "{boton}"')
def step_impl(context,boton):
    context.driver.find_element_by_link_text(boton).click()
    time.sleep(5.0)

@then(u'puedo ver en la página principal el nombre de mi usuario "{usuario}"')
def step_impl(context, usuario):
    respuesta = context.driver.find_element_by_partial_link_text(usuario).text
    assert usuario in respuesta

@then(u'puedo ver el mensaje de error "{mensaje}".')
def step_impl(context, mensaje):
    respuesta = context.driver.find_element_by_css_selector('div.alert').text
    assert mensaje in respuesta