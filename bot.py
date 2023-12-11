import time
from selenium import webdriver
from selenium.webdriver import Keys
from selenium.webdriver.common.by import By
import requests

driver = webdriver.Chrome()
driver.get('https://web.whatsapp.com/')

time.sleep(20)


def bot():
    try:
        #PEGA A BOLINHA NOTIF
        bolinha = driver.find_element(by=By.CLASS_NAME, value='aumms1qt')
        bolinha = driver.find_elements(by=By.CLASS_NAME, value='aumms1qt')
        clica_bolinha = bolinha[-1]

        acao_bolinha = webdriver.common.action_chains.ActionChains(driver)
        acao_bolinha.move_to_element_with_offset(clica_bolinha,0,-20)
        acao_bolinha.click()
        acao_bolinha.perform()
        acao_bolinha.click()
        acao_bolinha.perform()

        #PEGA O TELEFONE DO CLIENTE
        telefone_cliente = driver.find_element(by=By.XPATH, value='//*[@id="main"]/header/div[2]/div/div/span')
        telefone_final = telefone_cliente.text
        print(telefone_final)

        #PEGA MENSAGEM DO CLIENTE
        todas_as_msg = driver.find_elements(by=By.CLASS_NAME, value='_21Ahp')
        todas_as_msg_texto = [e.text for e in todas_as_msg]
        msg = todas_as_msg_texto[-1]
        print(msg)

        #RESPONDER MENSAGEM DO CLIENTE
        campo_de_texto = driver.find_element(by=By.XPATH, value='//*[@id="main"]/footer/div[1]/div/span[2]/div/div[2]/div[1]/div/div[1]')
        campo_de_texto.click()
        resposta = requests.get("http://localhost/ChatBot/index.php", params={'msg': {msg}, 'telefone': {telefone_final}})
        bot_resposta = resposta.text
        time.sleep(1)
        campo_de_texto.send_keys(bot_resposta, Keys.ENTER)

        #VOLTAR PARA CONTATO PADRÃO
        contato_padrao = driver.find_element(by=By.CLASS_NAME, value='_2XH9R')
        acao_contato = webdriver.common.action_chains.ActionChains(driver)
        acao_contato.move_to_element_with_offset(contato_padrao,0,-20)
        acao_contato.click()
        acao_contato.perform()
        acao_contato.click()
        acao_contato.perform()

    except:
        # print('buscando novas mensagens')
        time.sleep(1)

while True:
    bot()
